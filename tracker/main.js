((window) => {
  const {
    screen: { width, height },
    navigator: { language },
    location,
    localStorage,
    document,
    history,
  } = window;

  const { hostname, pathname, search } = location;
  const { currentScript } = document;
  if (!currentScript) return;

  const BASE_URL = currentScript.getAttribute("data-api")
    ? currentScript.getAttribute("data-api") + "/api"
    : "https://app.wanalytics.io/api";

  const ALLOW_LOCALHOST =
      currentScript.getAttribute("allow-localhost") == "true"
          ? true
          : false;

  const WEBSITE_ID = currentScript.getAttribute("website-id");
  if (!WEBSITE_ID) return;

  const assign = (a, b) => {
    Object.keys(b).forEach((key) => {
      if (b[key] !== undefined) a[key] = b[key];
    });
    return a;
  };

  const currentUrl = `${pathname}${search}`;
  let currentRef = document.referrer || null;
  let cache;

  document.querySelectorAll("[data-wanalytics-event]").forEach((element) => {
    element.addEventListener("click", (e) => {

      let data = {};
      const values = Object.keys(element.dataset);
      values.forEach((value) => {
        if (value != "wanalyticsEvent") {

          const key = value.replace("wanalyticsEvent", "");
          data[key] = element.dataset[value];
        }
      });

      const name = element.dataset.wanalyticsEvent;
      trackEvent(name, Object.keys(data).length >= 1 ? data : null);
    });
  });

  const getBrowser = () => {
    const agent = navigator.userAgent;

    let browser = {
      name: "Unknown",
      version: "Unknown",
    };

    if (agent.indexOf("Firefox") > -1) {
      browser = {
        name: "Firefox",
        version: agent.split("Firefox/")[1].split(" ")[0],
      };
    } else if (agent.indexOf("Opera") > -1 || agent.indexOf("OPR") > -1) {
      browser = {
        name: "Opera",
        version: agent.split("OPR/")[1],
      };
    } else if (agent.indexOf("Trident") > -1) {
      browser = "Internet Explorer";
    } else if (agent.indexOf("Edge") > -1) {
      browser = {
        name: "Edge",
        version: agent.split("Edge/")[1].split(" ")[0],
      };
    } else if (agent.indexOf("Chrome") > -1) {
      browser = {
        name: "Chrome",
        version: agent.split("Chrome/")[1].split(" ")[0],
      };
    } else if (agent.indexOf("Safari") > -1) {
      browser = {
        name: "Safari",
        version: agent.split("Version/")[1].split(" ")[0],
      };
    }

    return browser;
  };

  const getOS = () => {
    let userAgent = window.navigator.userAgent,
        platform = window.navigator.platform,
        macosPlatforms = ["Macintosh", "MacIntel", "MacPPC", "Mac68K"],
        windowsPlatforms = ["Win32", "Win64", "Windows", "WinCE"],
        iosPlatforms = ["iPhone", "iPad", "iPod"],
        os = null;

    if (macosPlatforms.indexOf(platform) !== -1) {
        os = "MacOS";
    } else if (iosPlatforms.indexOf(platform) !== -1) {
        os = "iOS";
    } else if (windowsPlatforms.indexOf(platform) !== -1) {
        os = "Windows";
    } else if (/Android/.test(userAgent)) {
        os = "Android";
    } else if (!os && /Linux/.test(platform)) {
        os = "GNU/Linux";
    } else if (!os && /X11/.test(platform)) {
        os = "Unix";
    } else {
        os = "Unknown";
    }

    return os;
  }

  const getDevice = () => {
      const ua = navigator.userAgent;
      if (/(tablet|ipad|playbook|silk)|(android(?!.*mobi))/i.test(ua)) {
          return "tablet";
      }
      if (
          /Mobile|iP(hone|od)|Android|BlackBerry|IEMobile|Kindle|Silk-Accelerated|(hpw|web)OS|Opera M(obi|ini)/.test(
              ua
          )
      ) {
          return "mobile";
      }
      return "desktop";
  };

  const getTrackEventPayload = () => ({
    hostname: hostname,
    website_id: WEBSITE_ID,
  });

  const getTrackViewPayload = () => ({
    hostname: hostname,
    screen: `${screen.width}x${screen.height}`,
    referrer: currentRef,
    url: {
      path: currentUrl,
      title: document.title,
    },
    language: language,
    website_id: WEBSITE_ID,
    os: getOS(),
    browser: getBrowser(),
    device: getDevice(),
    user_agent: navigator.userAgent,
  });

  const collect = (payload, path) => {
    if (hostname == "localhost" && !ALLOW_LOCALHOST) return;

    return fetch(`${BASE_URL}/${path}`, {
      method: "POST",
      body: JSON.stringify(payload),
      redirect: "follow",
      headers: assign(
        { "Content-Type": "application/json" },
        { ["x-cache"]: cache }
      ),
    });
  };

  const trackView = () =>
    collect(
      assign(getTrackViewPayload(), {}),
      "collect"
    );

  const trackEvent = (name, data) => {
    collect(
      assign(getTrackEventPayload(), {
        name,
        data,
      }),
      "event"
    );
  };
  trackView();
})(window);
