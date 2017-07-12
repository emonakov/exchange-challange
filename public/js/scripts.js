document.addEventListener("DOMContentLoaded", function() {
    let picker = new Pikaday({
        field: document.getElementById('datepicker'),
        container: document.getElementById('container'),
        firstDay: 1,
        minDate: new Date(1990, 12, 31),
        maxDate: new Date(),
        yearRange: [1990, 2020],
        format: 'YYYY-MM-DD',
        onSelect: addHistory,
        toString: function(date, format) {
            return dateFns.format(date, format);
        },
        parse: function(dateString, format) {
            return dateFns.parse(dateString);
        }
    });

    picker.show();

    let form = document.querySelector('#currency-form');
    form.addEventListener('change', function () {
        this.submit();
    });

    function addHistory() {
        let date = document.querySelector('#datepicker').value;
        let key = 'history';
        let value = date;
        let kvp = document.location.search.substr(1).split('&');
        let i = kvp.length;
        let x;
        key = encodeURI(key);
        value = encodeURI(value);
        while (i--) {
            x = kvp[i].split('=');
            if (x[0] == key) {
                x[1] = value;
                kvp[i] = x.join('=');
                break;
            }
        }
        if (i < 0) {
            kvp[kvp.length] = [key, value].join('=');
        }
        document.location.search = kvp.join('&');
    }
});