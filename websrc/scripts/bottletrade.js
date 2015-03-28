
function getTransformProperty(element) {
    // Note that in some versions of IE9 it is critical that
    // msTransform appear in this list before MozTransform
    var properties = [
        'transform',
        'WebkitTransform',
        'msTransform',
        'MozTransform',
        'OTransform'
    ];
    var p;
    while (p = properties.shift()) {
        if (typeof element.style[p] != 'undefined') {
            return p;
        }
    }
    return false;
}

$(window).load(function() {
	// modify file input buttons
	$('input[type=file].cropable-image').each(function() {
		transformFileInput(this);
	});
	
	// set timeout for alert message display (5s)
	setTimeout(function() { $('#onload-alert-placeholder .alert a.close').click(); }, 5000);
});

function sendFriendRequestResponse(formId, friendRequestID, response) {
	$('#' + formId + ' input[id$=Id]').val(friendRequestID);
	$('#' + formId + ' input[id$=Response]').val(response);
	$('#' + formId).submit();
}

var _EventManager = function (undefined) {
    var self = this;
    self.eventArray = ko.observableArray();
    self.eventIdSet = {};

    self.events = ko.computed(function() {
		return ko.utils.arrayFilter(self.eventArray(), function(eventData) {
            return eventData.eventType != yii.knockout.eventTypeIsoBeer;
        });
	}, this);
    
	self.bottles = ko.computed(function() {
		return ko.utils.arrayFilter(self.eventArray(), function(eventData) {
            return eventData.eventType == yii.knockout.eventTypeBottle;
        });
	}, this);

	self.trades = ko.computed(function() {
		return ko.utils.arrayFilter(self.eventArray(), function(eventData) {
            return eventData.eventType == yii.knockout.eventTypeTrade;
        });
	}, this);

	self.iso = ko.computed(function() {
		return ko.utils.arrayFilter(self.eventArray(), function(eventData) {
            return eventData.eventType == yii.knockout.eventTypeIsoBeer;
        });
	}, this);
	
	self.getKey = function(eventData) {
		return "k" + eventData.eventType + "-" + eventData.bottleId + "-" + eventData.tradeId + "-" + eventData.isoId;
	}
	
    self.addEvent = function (eventData) {
	    var key = self.getKey(eventData);
    	if (!self.eventIdSet.hasOwnProperty(key)) {
		    self.eventArray.push(eventData);
		    self.eventIdSet[key] = key;
		    return true;
    	}
    	return false;
    }
    
    self.removeEvent = function (eventData) {
	    var removeKey = self.getKey(eventData);
    	if (self.eventIdSet.hasOwnProperty(removeKey)) {
    		delete self.eventIdSet[removeKey];
		    self.eventArray.remove(function(item) { 
		    	var key = self.getKey(item);
		    	return key == removeKey;
		    });
		    return true;
    	}
    	return false;
    }
}

var _AjaxEventLoader = function () {
	var self = this;
	self.size = ko.observable(0);
	self.limit = ko.observable(20);
	self.offset = ko.observable(0);
	self.endReached = ko.observable(false);
	self.loadingData = ko.observable(false);
	self.dataUrl = ko.observable("");
	self.customUrlData = ko.observable("");
	self.eventLoadedCallback = ko.observable(null);

	self.loadMore = function() {
		if (!self.loadingData() && !self.endReached()) {
			self.loadingData(true);
			var apiUrl = self.dataUrl() + "?offset=" + self.offset() + "&limit=" + self.limit();
			if (self.customUrlData().length > 0) {
				apiUrl = apiUrl + "&" + self.customUrlData();
			}
	    	$.ajax({
	    	    type: 'GET',
	    	    url: apiUrl,
	    	    dataType: 'json',
	    	    error: function(data) {
	    	    	self.loadingData(false);
	    	    },
	    	    success: function(data){
	    	    	if (data.length == 0) {
		    	    	self.endReached(true);
	    	    	} else {
	    	    		$.map(data, function(eventData) {
	    	    			var callbackFunc = self.eventLoadedCallback();
	    	    			if (callbackFunc != null) {
	    	    				callbackFunc(eventData);
	    	    			} else {
					    	    KnockoutManager.EventManager().addEvent(eventData);
	    	    			}
		                });

	                    self.offset(self.offset() + data.length);

	    	    		if (data.length < self.limit()) {
			    	    	self.endReached(true);
	    	    		}
	    	    	}
	    	    	self.loadingData(false);
	    	    }
	    	});
		}
    }
}

var _NavigationManager = function(undefined){
    var self = this;
    self.goToTradeSummaryPage = function (item) {
    	window.location = yii.urls.tradeSummary + item.tradeId; 
    	return false;
    }
    self.goToUserProfile = function (item) {
    	window.location = yii.urls.profile + item.username; 
    	return false;
    }
    self.goToMakeOfferWithUsername = function(item) {
    	window.location = yii.urls.makeOffer + item.username + "?type=un"; 
    	return false;
    }
}

var _IsoManager = function () {
	var self = this;
	self.loader = ko.observable(new _AjaxEventLoader());
	
	self.removeEntry = function (item) {
		if (confirm('Are you sure you want to remove this ISO entry')) {
			$.ajax({
			    type: 'POST',
			    url: bottletrade.apis.iso.remove + "?id=" + item.isoId,
			    dataType: 'json',
			    error: function() {
			    	self.loader().loadingData(false);
			    },
			    success: function(data){
			    	KnockoutManager.EventManager().removeEvent(data);
			    	self.loader().loadingData(false);
			    }
			});
		}
		return false;
    }
    self.addBeer = function (beerId) {
    	$.ajax({
    	    type: 'POST',
    	    url: bottletrade.apis.iso.addBeer + "?id=" + beerId,
    	    dataType: 'json',
    	    error: function() {
    	    	self.loader().loadingData(false);
    	    },
    	    success: function(data){
        		KnockoutManager.EventManager().addEvent(data);
    	    	self.loader().loadingData(false);
    	    	
    	    	$('#success-alert-msg-placeholder').html("You successfully added to your ISO list.  Click <a href='javascript:$(bottletrade.popups.iso).click();'>here</a> to view your ISO list.");
    	        $("#success-alert-placeholder.alert").addClass("in");
    	    	$("#success-alert-placeholder").show();
    	    	
    	    	// set timeout for alert message display (10s)
    	    	setTimeout(function() { $('#success-alert-placeholder.alert').removeClass("in"); $("#success-alert-placeholder").hide();}, 10000);
    	    }
    	});
    	return false;
    }
}

var _KnockoutManager = function(undefined){
    var self = this;
    self.EventManager = ko.observable(new _EventManager());
    self.FeedManager = ko.observable(new _AjaxEventLoader());
    self.CyberCellarManager = ko.observable(new _AjaxEventLoader());
    self.HashTagManager = ko.observable(new _AjaxEventLoader());
    self.NavigationManager = ko.observable(new _NavigationManager());
    self.BottleManager = ko.observable();
    self.IsoManager = ko.observable();
    self.TradeManager = ko.observable();
    self.TradeMessageManager = ko.observable();
    self.MessageSenderManager = ko.observable();
    self.MessageReplyManager = ko.observable();
    self.ProfileManager = ko.observable();
    self.NewBeverageManager = ko.observable();
    self.NewCompanyManager = ko.observable();
    self.AccountSettingsManager = ko.observable();
    self.SearchManager = ko.observable();
    self.FindTraderManager = ko.observable();
}

var KnockoutManager = new _KnockoutManager();

$(window).load(function() {
	ko.applyBindings(KnockoutManager, document.getElementById(yii.knockout.bindingId));
	$('.event-container').show();
});