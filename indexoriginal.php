<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Student Manager</title>
  </head>
  <body>
    <h2>Student Information Manager</h2>
    <h3>Main Data Entry Form</h3>
    <form action="insert.php" method="post" enctype="multipart/form-data">
      <table>
        <tr>
          <td>SID</td>
          <!-- <td><input type="text" name="stdid" readonly="readonly"</td> -->
          <td><input type="text" name="stdid" disabled="disabled"</td>
          <!-- <td><input type="text" name="stdid"</td> -->
        </tr>
        <tr>
          <td>First Name</td>
          <td><input type="text" name="fname"</td>
        </tr>
        <tr>
          <td>Last Name</td>
          <td><input type="text" name="lname"</td>
        </tr>
        <tr>
          <td>SSN (Optional)</td>
          <td><input type="text" name="ss" placeholder="xxx-xx-xxxx" pattern="\d{3}-?\d{2}-?\d{4}"></td>
        </tr>
        <tr>
          <td>Date of birth</td>
          <td><input type="date" name="birthday"</td>
        </tr>
        <tr>
          <td>Gender</td>
          <td><input type="radio" name="stdgender" value="Male">Male
              <input type="radio" name="stdgender" value="Female">Female
              <input type="radio" name="stdgender" value="Other">Other</td>
        </tr>
        <tr>
          <td>Race</td>
          <!-- <td><input type="text" name="race"</td> -->
          <td>
            <select class="" name="stdrace">
              <option value="">-- Make a selection --</option>
              <option value="Hispanic or Latino">Hispanic or Latino</option>
              <option value="American Indian or Alaska Native (not Hispanic or Latino)">American Indian or Alaska Native (not Hispanic or Latino)</option>
              <option value="Asian (not Hispanic or Latino)">Asian (not Hispanic or Latino)</option>
              <option value="Black or African American (not Hispanic or Latino)">Black or African American (not Hispanic or Latino)</option>
              <option value="Native Hawaiian or Other Pacific Islander (not Hispanic or Latino)">Native Hawaiian or Other Pacific Islander (not Hispanic or Latino)</option>
              <option value="Two or More Races (not Hispanic or Latino)">Two or More Races (not Hispanic or Latino)</option>
              <option value="White (not Hispanic or Latino)">White (not Hispanic or Latino)</option>
              <option value="Opt Out">Opt Out</option>
            </select>
          </td>
        </tr>
        <tr>
          <td>Avatar</td>
          <td><input type="file" name="stdavatar"</td>
        </tr>
        <tr>
          <td>Submissions</td>
          <td><input type="file" name="stdsubmission"</td>
        </tr>
        <tr>
          <!-- <button type="" name="savedata">SAVE DATA</button> -->
          <td><input type="submit" name="savedata" value="SAVE DATA"></td>
          <td><input type="submit" name="display" value="VIEW RECORDS"></td>
        </tr>
      </table>
    </form>
  </body>
</html>
ody>
</html>
