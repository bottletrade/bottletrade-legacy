<?php $this->beginContent('/layouts/mail'); ?>
There was a new beverage added to the Bottle Trade Network.<br>
Find the details below:<br><br>

Name: <?php echo $beverage->Name; ?><br>
Brewery ID: <?php echo $beverage->BreweryID; ?><br>
Style: <?php echo $beverage->StyleID; ?><br>
ABV: <?php echo $beverage->ABV; ?><br>
IBU: <?php echo $beverage->IBU; ?><br>
SRM: <?php echo $beverage->SRM; ?><br>
UPC: <?php echo $beverage->UPC; ?><br>
Availability: <?php echo $beverage->Availability; ?><br>
Description: <?php echo $beverage->Description; ?><br>
User that added this company: <?php echo $beverage->UserAdded; ?><br>
Time Created: <?php echo $beverage->CreatedTime; ?><br>
Last time updated: <?php echo $beverage->LastUpdateTime; ?><br><br>

To edit this entry click <a href="<?php echo UrlUtils::generateUrl(UrlUtils::BeerUpdateUri, $beverage->ID); ?>">here</a>.

<?php $this->endContent(); ?>