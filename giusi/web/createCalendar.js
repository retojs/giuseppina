var NAMES = ['HP', 'Lotta'],
    NAMES_COUNT = NAMES.length,
    START_WITH_NAME = "HP",
    START_WITH_NAME_INDEX = NAMES.indexOf(START_WITH_NAME),
    START_WITH_WEEK = 14,
    NOF_WEEKS = 30,
    WEEKS_PER_NAME = 2,
    FIRST_WEEKDAYS = [6, 7, 1, 2, 4, 5, 6, 7, 2, 3, 4, 5, 7, 1, 2, 3, 5, 6, 7, 1]; //first weekday for next 20 years, starting from 2005. (1=mo, 2=di .. 6=sa, 7=so)

function getCalendar(year) {

    var firstWeekday = FIRST_WEEKDAYS[year - 2005],
        date = moment(year + '0101', 'YYYYMMDD'),
        startSaturday = 7 * (START_WITH_WEEK - 2)
            + (6 - firstWeekday)
            + (firstWeekday < 6 ? 0 : 7);

    date.add(startSaturday, 'days');

    var calendar = '';
    for (var i = 0; i < NOF_WEEKS; i++) {
        var von = date.format('DD.MM');
        date.add(7, 'days');
        var bis = date.format('DD.MM');
        calendar += (i > 0 ? '\n' : '')
            + (START_WITH_WEEK + i) + ', ' + von + ' - ' + bis + ', ' + NAMES[(START_WITH_NAME_INDEX + Math.floor(i / WEEKS_PER_NAME)) % NAMES_COUNT] + ';';
        console.log(i / WEEKS_PER_NAME);
    }
    return calendar
}
