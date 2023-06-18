import colorLib from '@kurkle/color';

const timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;

export default {
    kFormatter(num) {
        return Math.abs(num) > 999
            ? Math.sign(num) * (Math.abs(num) / 1000).toFixed(1) + "k"
            : Math.sign(num) * Math.abs(num);
    },

    secondsToTime(secs) {
        const minutes = Math.floor(secs / 60);

        const seconds = secs - minutes * 60;

        return `${minutes}m ${seconds}s`;
    },

    calcTotal(data) {
        if (Object.keys(data).length === 0) return;

        return data.reduce((a, b) => {
            return a + b.y;
        }, 0);
    },

    calcPercentage(total, value) {
        if (total === 0) return 0;

        return ((value / total) * 100).toFixed(0);
    },

    transparentize(value, opacity) {
        var alpha = opacity === undefined ? 0.5 : 1 - opacity;
        return colorLib(value).alpha(alpha).rgbString();
    },

    formatDate(date) {
        return dayjs(date).tz(timezone).format("MMMM D, YYYY");
    },

    formatTime(date) {
        return dayjs(date).tz(timezone).format("h:mm A");
    },

    formatDateTime(date) {
        return dayjs.utc(date).tz(timezone).format("MMMM D, YYYY h:mm A");
    },
};
