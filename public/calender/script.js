function Calender() {
    var d = new Date();
    var month = d.getMonth();
    var date = d.getDate();
    var year = d.getFullYear();
    var day = d.getDay();
    var firstD = new Date(year, month, 1);
    var lastD = new Date(year, month + 1, 0);
    var firstDay = firstD.getDay();
    var lastDate = lastD.getDate();
    var table = document.createElement("TABLE");
    var calenderId = document.getElementById('calender');
    var labelDays =  ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab',];
    var nextDay = 0;
    var tr;
    var td;

    this.labelDay = function() {
        tr = document.createElement("TR");
        tr.className += "label-calender";
        for (let x = 0; x < 7; x++) {
            td = document.createElement("TD");
            label = document.createTextNode(labelDays[x]);
            td.appendChild(label);
            tr.appendChild(td);
            table.appendChild(tr);
        }
    };

    this.firstWeek = function(){
        tr = document.createElement("TR")
        for(var i = 0; i < 7; i++){
            td = document.createElement("TD");
            if(i == 0) { td.className += "sunday"}
            if(i < firstDay){
                tr.appendChild(td);
                table.appendChild(tr);
            }
            else{
                nextDay++;
                num = document.createTextNode(nextDay);
                td.appendChild(num);
                if(nextDay == date) {td.className += ' today';}
                tr.appendChild(td);
                table.appendChild(tr);
            }
        }
    };

    this.nextWeek = function() {
        for(var i = 0; i < lastDate; i++){
            var chkWeek = i % 7;
            nextDay++;
            num = document.createTextNode(nextDay);
            td = document.createElement("TD");
            if(nextDay == date) {td.className += 'today';}
            if(nextDay == lastDate + 1){break}
            else{
                if(chkWeek == 0) {
                    tr = document.createElement("TR");
                    td.className += " sunday";
                    td.appendChild(num);
                    tr.appendChild(td);
                    table.appendChild(tr);
                }
                else{
                    td.appendChild(num);
                    tr.appendChild(td);
                    table.appendChild(tr);
                }
            }
        }
    };

    this.draw = function() {
        this.labelDay();
        this.firstWeek();
        this.nextWeek();
        calenderId.appendChild(this.displayMonthYear());
        calenderId.appendChild(table);
        table.className += 'calender';
    };

    this.displayMonthYear = function(){
        var getMonth = document.createTextNode(this.getMonth());
        var getYear = document.createTextNode(" " + this.getYear());
        var div = document.createElement("H1");
        div.appendChild(getMonth);
        div.appendChild(getYear);
        return div;
    };

    this.getDay = function(n = day) {
        var formatDay = [
            'Minggu', 'Senin', 'Selasa',
            'Rabu', 'Kamis', 'Jumat', 'Sabtu',
        ];
        return formatDay[n];
    };

    this.getMonth = function(n = month) {
        var formatMonth = [
            "Januari", "Febuari", "Maret",
            "April", "Mei", "Juni",
            "Juli", "Agustus", "September",
            "Oktober", "November", "Desember",
        ];
        return formatMonth[n];
    };

    this.getYear = function(n = year) {
        return n;
    }

    this.getDate = function(n = date) {
        return n;
    }

    this.callMonth = function(n = date) {
        return n;
    }
}
