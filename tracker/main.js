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

  const getTrackEventPayload = () => ({
    hostname: hostname,
    website_id: WEBSITE_ID,
  });

  const getTrackViewPayload = () => ({
    hostname: hostname,
    screen: `${screen.width}x${screen.height}`,
    referrer: currentRef,
    url: currentUrl,
    language: language,
    website_id: WEBSITE_ID,
  });

  const collect = (payload, path) => {

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
