const browsers = [
    { code: "US", name: "United States", flag: "🇺🇸" },
    { code: "CA", name: "Canada", flag: "🇨🇦" },

];

export default {
    getBrowserName (name) {
        // let country = countries.find((c) => c.code === code);
        // if (country) {
        //     return country.name;
        // }
        console.log(name)
        return name;
    },

    getBrowserIcon (code) {
        let country = countries.find((c) => c.code === code);
        if (country) {
            return country.flag;
        }
        return code;
    },
};
