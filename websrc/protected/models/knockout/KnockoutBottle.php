<?php
    class KnockoutBottle extends KnockoutModel
    {
        public static function MakeEmptyData() {
        	self::generateEmptyData();
        	return self::$data;
        }
        
        public static function MakeDataWithForm($form) {
        	self::generateDataWithForm($form);
        	return self::$data;
        }
        
        public static function MakeFeedDataWithBottle($bottle) {
        	self::generateFeedDataWithBottle($bottle);
        	return self::$data;
        }
        
        public static function MakeDataWithBottle($bottle) {
        	self::generateDataWithBottle($bottle);
        	return self::$data;
        }

        public static function MakeFeedDataWithEvent($event) {
        	self::generateDataWithEvent($event);
        	return self::$data;
        }

        private static function generateEmptyData() {
        	self::reset();
        	self::$data["eventType"] = KnockoutEventType::BOTTLE;
        	self::$data["beverageType"] = BeverageType::BEER;
        	self::$data["companyType"] = CompanyType::BREWERY;
        	self::$data["imgSrc"] = ImageUtils::getDefaultBottleImageUrl();
        }
        
        private static function generateDataWithForm($form) {
        	self::generateEmptyData();
        	self::$data["imageName"] = $form->imagename;
        	self::$data["beverageType"] = $form->beverageType;
        	self::$data["companyType"] = CompanyType::BREWERY;
        	self::$data["beverageName"] = $form->beverageName;
        	self::$data["companyName"] = $form->companyName;
        	self::$data["companyId"] = $form->companyId;
        	self::$data["imgSrc"] = empty($form->imagename) ? ImageUtils::getDefaultBeerImageUrl() : ImageManager::getTempFileUrl($form->imagename);
        	self::$data["bottleId"] = $form->bottleId;
        	self::$data["beerId"] = $form->beerId;
        	self::$data["wineId"] = $form->wineId;
        	self::$data["spiritId"] = $form->spiritId;
        	self::$data["fluidAmount"] = $form->fluidAmount;
        	self::$data["purchasePrice"] = $form->purchasePrice;
        	self::$data["bottledOnDate"] = $form->bottledOnDate;
        	self::$data["quantity"] = $form->quantity;
        	self::$data["description"] = $form->description;
        	self::$data["isTradeable"] = $form->isTradeable;
        	self::$data["isSearchable"] = $form->isSearchable == 1 ? true : false;
        	self::$data["isPrivate"] = $form->isPrivate == 1 ? true : false;
        	return self::$data;
        }
        
        private static function generateFeedDataWithBottle($bottle) {
        	self::generateDataWithBottle($bottle);
        	self::$data["time"] = $bottle->CreatedTime;
        	self::$data["hashtags"] = HashTag::convertHashTagsToLinks(implode(" ", HashTag::stripOutHashTags($bottle->Description)));
        }
        
        private static function generateDataWithBottle($bottle)
        {
        	self::generateEmptyData();
        	self::$data["username"] = $bottle->user->Username;
        	self::$data["beverageType"] = Bottle::getBeverageType($bottle);
        	self::$data["imgSrc"] = ImageManager::getImageUrlStatic($bottle);
        	self::$data["bottleId"] = $bottle->ID;
        	self::$data["beerId"] = $bottle->BeerID;
        	self::$data["wineId"] = $bottle->WineID;
        	self::$data["spiritId"] = $bottle->SpiritID;
        	self::$data["companyId"] = Bottle::getCompanyID($bottle);
        	self::$data["companyType"] = Bottle::getCompanyType($bottle);
        	self::$data["companyName"] = Bottle::getCompanyName($bottle);
        	self::$data["companyCity"] = Bottle::getCompanyCity($bottle);
        	self::$data["companyState"] = Bottle::getCompanyState($bottle);
        	self::$data["styleName"] = Bottle::getStyleName($bottle);
        	self::$data["beverageName"] = Bottle::getBeverageName($bottle);
        	self::$data["fluidAmount"] = $bottle->FluidAmount;
        	self::$data["abv"] = Bottle::getBeverageAbv($bottle);
        	self::$data["purchasePrice"] = $bottle->PurchasePrice;
        	self::$data["bottledOnDate"] = Bottle::getBottledOnDate($bottle);
        	self::$data["year"] = Bottle::getBottledOnYear($bottle);
        	self::$data["bottledOnDateDisplay"] = Bottle::getBottledOnDateDisplay($bottle);
        	self::$data["quantity"] = $bottle->Quantity;
        	self::$data["description"] = $bottle->Description;
        	self::$data["isTradeable"] = $bottle->IsTradeable == 1 ? "Yes" : "No";
        	self::$data["isSearchable"] = $bottle->IsSearchable == 1 ? true : false;
        	self::$data["isPrivate"] = $bottle->IsPrivate == 1 ? true : false;
        	self::$data["isEditable"] = Bottle::isOwnedByCurrentUser($bottle);
        }

        private static function generateDataWithEvent($event) {
        	self::generateEmptyData();
        	self::$data["bottleId"] = $event->BottleID;
        	self::$data["beverageType"] = Bottle::getBeverageType($event);
        	self::$data["imgSrc"] = ImageManager::getImageUrlStatic($event);
        	self::$data["beerId"] = $event->BeerID;
        	self::$data["wineId"] = $event->WineID;
        	self::$data["spiritId"] = $event->SpiritID;
        	self::$data["companyId"] = Bottle::getCompanyID($event);
        	self::$data["companyType"] = Bottle::getCompanyType($event);
        	self::$data["companyName"] = Bottle::getCompanyName($event);
        	self::$data["companyCity"] = Bottle::getCompanyCity($event);
        	self::$data["companyState"] = Bottle::getCompanyState($event);
        	self::$data["styleName"] = Bottle::getStyleName($event);
        	self::$data["beverageName"] = Bottle::getBeverageName($event);
        	self::$data["fluidAmount"] = $event->FluidAmount;
        	self::$data["abv"] = Bottle::getBeverageAbv($event);
        	self::$data["purchasePrice"] = $event->PurchasePrice;
        	self::$data["bottledOnDate"] = Bottle::getBottledOnDate($event);
        	self::$data["year"] = Bottle::getBottledOnYear($event);
        	self::$data["bottledOnDateDisplay"] = Bottle::getBottledOnDateDisplay($event);
        	self::$data["quantity"] = $event->Quantity;
        	self::$data["description"] = $event->Description;
        	self::$data["isTradeable"] = $event->IsTradeable == 1 ? "Yes" : "No";
        	self::$data["isSearchable"] = $event->IsSearchable == 1 ? true : false;
        	self::$data["isPrivate"] = $event->IsPrivate == 1 ? true : false;
        	self::$data["isEditable"] = Bottle::isOwnedByCurrentUser($event);
        	self::$data["username"] = $event->user->Username;
        	self::$data["time"] = $event->EventTime;
        	self::$data["hashtags"] = HashTag::convertHashTagsToLinks(implode(" ", HashTag::stripOutHashTags($event->Description)));
        
        }
    }
