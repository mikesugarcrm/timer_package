
({
    direction: '',
    dateFieldName: '',
    cancelInterval: null,

    initialize: function(options) {
        this._super('initialize', arguments);
        this.dateFieldName = this.determineDateFieldName();
        this.direction = this.determineDirection();
    },


    getDateFieldValue: function(fieldName) {
        var field = this.view.getField(fieldName);
        if (_.isUndefined(field)) {
            console.log("The field name " + fieldName + " is not a valid field");
            return '';
        }

        return this.model.get(field.name);
    },


    determineDirection: function() {
        if (!_.isEmpty(this.def.field_start_from)) {
            return 'from';
        }

        if (!_.isEmpty(this.def.field_start_to)) {
            return 'to';
        }
    },


    determineDateFieldName: function() {
        if (!_.isEmpty(this.def.field_start_from)) {
            return this.def.field_start_from;
        }

        if (!_.isEmpty(this.def.field_start_to)) {
            return this.def.field_start_to;
        }
        console.log(this.name + " does not define a field_start_from or a field_start_to for this view controller - " + this.model.module + " - " + this.view.name);
    },


    updateTimer: function() {
        // do not call set here - kicks of a cascade of unintended _render() calls in other views!
        if (this.$el) {
            if (this.$el.children()[0]) {
                this.value = this.format();
                this.$el.children()[0].innerHTML = this.format();
            } else {
                // DO call set here - it actually renders the template as we expect above.
                this.model.set(this.name, this.format());
            }
        }
    },

    _render: function() {
        if (this.value) {
            this.updateTimer();
        }
        this._loadTemplate();
        this._super('_render', arguments);

        if (_.isNull(this.cancelInterval)) {
            var self = this;
            this.cancelInterval = setInterval(function(self) {
                self.updateTimer();
            }, 1000, this);
         }
    },


    format: function() {
        if (_.isEmpty(this.dateFieldName)) {
            console.log('Could not determine dateFieldName.');
            return '';
        }

        if (!this.model.get('id') || !this.model.get(this.dateFieldName)) {
            return '';
        }

        var now = new Date();
        var dateFieldDateObj = new Date(this.getDateFieldValue(this.dateFieldName));

        var nowTS = now.getTime();
        var dateFieldTS = dateFieldDateObj.getTime();
        var diffTS = (nowTS - dateFieldTS) / 1000; // getTime() returns microseconds.

        if (this.direction == 'to') {
            // 'to' means how long until we arrive at the date specified by dateFieldDateObj.
            // dateFieldDateObj assumed to be in the future.
            // diffTS assumed to be negative integer that increases (gets closer to zero) every second.
            diffTS = diffTS * -1;
        } else {
            // 'from' means how long has passed since the date specified by dateFieldDateObj.
            // dateFieldDateObj assumed to be in the past.
            // diffTS assumed to be positive integer that decreases every second.
        }

        if (diffTS <= 0) {
            return "Expired";
        }

        var days = Math.floor(diffTS / (60 * 60 * 24));
        var hours = Math.floor((diffTS % (60 * 60 * 24)) / (60 * 60));
        var minutes = Math.floor((diffTS % (60 * 60)) / 60);
        var seconds = Math.floor(diffTS % 60);

        if (hours < 10) {
            hours = '0' + hours;
        }

        if (minutes < 10) {
            minutes = '0' + minutes;
        }

        if (seconds < 10) {
            seconds = '0' + seconds;
        }

        return this._super('format', [days + "d " + hours + "h " + minutes + "m " + seconds + "s"]);
    },

    unformat: function(value) {
        return this._super('unformat', arguments);
    }
})