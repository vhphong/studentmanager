<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Student Manager</title>
  </head>
  <body>
    <center>
      <h2>Student Manager</h2>
      <h3>Student 's Information Entry Form</h3>
    </center>
    <hr width = 100%>
    <form action="insert.php" method="post">
      <table>
        <tr>
          <td>SID</td>
          <!-- <td><input type="text" name="stdid" readonly="readonly"</td> -->
          <td><input type="text" name="stdid" disabled="disabled"></td>
          <!-- <td><input type="text" name="stdid"</td> -->
        </tr>
        <tr>
          <td>First Name</td>
          <td><input type="text" name="fname"></td>
        </tr>
        <tr>
          <td>Last Name</td>
          <td><input type="text" name="lname"></td>
        </tr>
        <tr>
          <td>SSN (Optional)</td>
          <td><input type="text" name="ss" placeholder="xxx-xx-xxxx" pattern="\d{3}-?\d{2}-?\d{4}"></td>
        </tr>
        <tr>
          <td>Date of birth</td>
          <td><input type="date" name="birthday"></td>
        </tr>
        <tr>
          <td>Gender</td>
          <td>
            <input type="radio" name="stdgender" value="Male">Male
            <input type="radio" name="stdgender" value="Female">Female
            <input type="radio" name="stdgender" value="Other">Other
          </td>
        </tr>
        <tr>
          <td>Race</td>
          <!-- <td><input type="text" name="race"</td> -->
          <td>
            <select class="" name="stdrace">
              <option value="">Choose the best described ...</option>
              <option value="Alaskan or Native American">Alaskan or Native American</option>
              <option value="Hispanic or Latino">Hispanic or Latino</option>
              <option value="Asian (Not Hispanic or Latino)">Asian (Not Hispanic or Latino)</option>
              <option value="Black or African American (Not Hispanic or Latino)">Black or African American (Not Hispanic or Latino)</option>
              <option value="White (Not Hispanic or Latino)">White (Not Hispanic or Latino)</option>
              <option value="Decline to self-indentify">Decline to self-indentify</option>
              <option value="Other">Other</option>
            </select>
          </td>
        </tr>
        <tr>
          <td>Avatar</td>
          <td><input type="file" name="avatar"></td>
        </tr>
        <tr>
          <td>Submissions</td>
          <td><input type="file" name="stdsubmission"></td>
        </tr>
        <tr>
          <!-- <button type="" name="insert">Submit</button> -->
          <td><input type="submit" name="insert" value="INSERT"></td>
          <td><input type="submit" name="display" value="VIEW RECORDS"></td>
        </tr>
      </table>
    </form>
  </body>
</html>
