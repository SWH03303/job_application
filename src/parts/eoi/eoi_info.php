<?php $D = $D[0];?>

<article class="flex-y flex-o box">
	<div class="flex flex-y eoi-front">
		<p>Applicant ID: <?= $D['user_id'] ?></p>
		<p>Job ID: <?= $D['job_id'] ?></p>
		<p>Status: <?= $D['status'] ?></p>
		<p>Desired Salary: <?= $D['desired_salary'] ?></p>
		<p>Start Date: <?= $D['start_date'] ?></p>
	</div>

    <details class="flex flex-y eoi-details">
        <summary></summary>

        <?php $A = $D['applicant_info']; $A = $A[0]?>

        <p>Name: <?= $A['first_name'] . ' ' . $A['last_name'] ?></p>
        <p>DOB: <?= $A['dob'] ?></p>
        <p>Gender: <?= $A['gender'] ?></p>

        <p>Address: <?= $A['street'] ?>, <?= $A['town'] ?>, <?= $A['state'] ?> <?= $A['postcode'] ?></p>
        <p>Phone: <?= $A['phone'] ?></p>

        <p>Can Background Check: <?= $A['can_check_background'] ? 'Yes' : 'No' ?></p>
        <p>Is Convict: <?= $A['is_convict'] ? 'Yes' : 'No' ?></p>
        <p>Is Veteran: <?= $A['is_veteran'] ? 'Yes' : 'No' ?></p>

        <hr>

        <p>EOI Extra: <?= $D['extra'] ?></p>
        <p>Reason: <?= $D['reason'] ?></p>

        <hr>
        <div>
            <form method="POST" action="">
                <input type="Submit" name="delete" value="Delete">
                <input type="Submit" name="change_status" value="Change Status">
            </form>
        </div>
        
    </details>
</article>

