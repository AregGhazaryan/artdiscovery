(function (global, factory) {
    typeof exports === 'object' && typeof module !== 'undefined' ? module.exports = factory() :
    typeof define === 'function' && define.amd ? define(factory) :
    (global = global || self, (global.FullCalendarLocales = global.FullCalendarLocales || {}, global.FullCalendarLocales.hy = factory()));
}(this, function () { 'use strict';

    var ru = {
        code: "hy",
        week: {
            dow: 1,
            doy: 4 // The week that contains Jan 4th is the first week of the year.
        },
        buttonText: {
            prev: "Նախորդ",
            next: "Հաջորդ",
            today: "Այսօր",
            month: "Ամիս",
            week: "Շաբաթ",
            day: "Օր",
            list: "Ցանկ"
        },
        weekLabel: "Շաբ",
        allDayText: "Ամբողջ օր",
        eventLimitText: function (n) {
            return "+ և " + n;
        },
        noEventsMessage: "Իրադարձություններ չկան"
    };

    return ru;

}));
