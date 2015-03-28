<?php
	class KnockoutModel 
	{
		protected static $data;
		
		protected static function reset() {
			self::$data = array();
			// event meta data
			self::$data["eventType"] = "";
			self::$data["tradeId"] = "";
			self::$data["bottleId"] = "";
			self::$data["isoId"] = "";
			
			// shared
			self::$data["imgSrc"] = "";
			self::$data["time"] = "";
			self::$data["username"] = "";
			self::$data["beverageName"] = "";
			self::$data["companyName"] = "";
			self::$data["beverageUrl"] = "";
			self::$data["companyUrl"] = "";
			self::$data["isEditable"] = false;
			
			// bottle
			self::$data["beverageType"] = "";
			self::$data["imageName"] = "";
			self::$data["companyId"] = "";
			self::$data["companyType"] = "";
			self::$data["bottleId"] = "";
			self::$data["beerId"] = "";
			self::$data["wineId"] = "";
			self::$data["spiritId"] = "";
			self::$data["companyCity"] = "";
			self::$data["companyState"] = "";
			self::$data["styleName"] = "";
			self::$data["label"] = "";
			self::$data["fluidAmount"] = "";
			self::$data["abv"] = "";
			self::$data["purchasePrice"] = "";
			self::$data["year"] = "";
			self::$data["bottledOnDate"] = "";
			self::$data["bottledOnDateDisplay"] = "";
			self::$data["quantity"] = "";
			self::$data["description"] = "";
			self::$data["descriptionWithLinks"] = "";
			self::$data["isTradeable"] = false;
			self::$data["isSearchable"] = true;
			self::$data["isPrivate"] = false;
			 
			// bottle feed data
			self::$data["hashtags"] = "";
			
			// trade feed data
			self::$data["otherUsername"] = "";
		}
	}