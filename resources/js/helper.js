export default {
    kFormatter(num) {
        return Math.abs(num) > 999
        ? Math.sign(num) * (Math.abs(num) / 1000).toFixed(1) + "k"
        : Math.sign(num) * Math.abs(num);
    },

    calcTotal(data) {
        return data.reduce((a, b) => {
            return a + b.y;
        }, 0);
    },

    calcPercentage(total, value)
    {
        return ((value/total) * 100).toFixed(0);
    }
};
