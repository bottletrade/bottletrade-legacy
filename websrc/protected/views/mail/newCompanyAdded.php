<?php $this->beginContent('/layouts/mail'); ?>
There was a new brewery added to the Bottle Trade Network.<br>
Find the details below:<br><br>

Name: <?php echo $company->Name; ?><br>
Address: <?php echo $company->Address1; ?><br>
Extended Address: <?php echo $company->Address2; ?><br>
City: <?php echo $company->City; ?><br>
State: <?php echo $company->State; ?><br>
Zip Code: <?php echo $company->Code; ?><br>
Country: <?php echo $company->Country; ?><br>
Phone: <?php echo $company->Phone; ?><br>
Website: <?php echo $company->Website; ?><br>
Established: <?php echo $company->Established; ?><br>
Description: <?php echo $company->Description; ?><br>
User that added this company: <?php echo $company->UserAdded; ?><br>
Time Created: <?php echo $company->CreatedTime; ?><br>
Last time updated: <?php echo $company->LastUpdateTime; ?><br><br>

To edit this entry click <a href="<?php echo UrlUtils::generateUrl(UrlUtils::BreweryUpdateUri, $company->ID);?>">here</a>.


<?php $this->endContent(); ?>