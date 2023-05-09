<?php
function Passport() {
echo 'Now you can download a DogeTopis Passport PDF! DogeTopia Passports are not real documents, they are just for fun.';
echo '<a href="Passport.pdf" download>Download A Passport PDF here</a>';
}
?>



<h1>Applying for citizenship for Dogetopia</h1>
<br>
<h2>It is still under work</h2>
<br>
<h2>You can apply for a fake citizenship for Dogetopia</h2>
<form method='post' action='application.php'>
<label>Type in your name</label><br>
<input type='text' name='name'><br><br>
<label>Type in your country</label><br>
<input type='text' name='country'><br><br>
<label>What languages do you speak?</label><br>
<input type='text' name='language'><br><br>
<label>Date of birth (mm/dd/yyyy)</label><br>
<input type='text' name='birthdate'><br><br>
<label>How did you learn of this micronation?</label><br>
<input type='text' name='learn'><br><br>
<label>What is your gender?</label><br>
<input type='radio' name='gender' placeholder='male' value='male'>Male  <input type='radio' name='gender' placeholder='female' value='female'>Female<br><br>
<input type='submit' name='enter' value='Submit Form'>
</form>

<?php

if (isset($_POST['enter'])) {
$fp = fopen("members.html", 'a');
$APPLY = "<h1>Name: ". $_POST['name'] .", Gender; ". $_POST['gender'] .", Country: ". $_POST['country'] .", Languages: ". $_POST['languages'] .", Birth Date: ". $_POST['birthdate'] .", Found out from: ". $_POST['learn'] .".</h1>\n";
fwrite($fp, $APPLY);
fclose($fp);

Passport();
}
?>