<!DOCTYPE html>
<html>
<head>
    <title>Assessment Form</title>
</head>
<body>

<h2>Assessment Form</h2>

<form action="/assessment" method="POST">
    @csrf

    <input type="text" name="age" placeholder="Age"><br><br>

    <input type="text" name="school_university" placeholder="School/University"><br><br>

    <input type="text" name="study_year" placeholder="Study Year"><br><br>

    <input type="text" name="favorite_activity" placeholder="Favorite Activity"><br><br>

    <input type="text" name="interested_fields" placeholder="Interested Fields"><br><br>

    <input type="text" name="current_need" placeholder="Current Need"><br><br>

    <input type="text" name="join_workshop" placeholder="Join Workshop (1 or 0)"><br><br>

    <input type="text" name="commitment_level" placeholder="Commitment Level"><br><br>

    <input type="text" name="career_goal" placeholder="Career Goal"><br><br>

    <input type="text" name="biggest_challenge" placeholder="Biggest Challenge"><br><br>

    <input type="text" name="career_awareness" placeholder="Career Awareness (1 or 0)"><br><br>

    <input type="text" name="work_preference" placeholder="Work Preference"><br><br>

    <button type="submit">Save</button>

</form>

</body>
</html>
