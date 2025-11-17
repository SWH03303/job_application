<?php $D = $D[0];?>

<article class="flex-y flex-o box">
    <?php
        $db = Database::get();

        
        $delete_individual = $_POST['delete_individual'] ?? '';
        $status_change_individual = $_POST["status_change_individual"] ?? '';
        $id = $_POST['id'] ?? '';
        $accpeted_statuses = ['New', 'Current', 'Final'];

        if ($delete_individual && $id == $D['id']) {
            $db->query('DELETE FROM eoi WHERE id = ?', [$D['id']]);
            return;
        } elseif ($status_change_individual && $id == $D['id']) {
            if (in_array($status_change_individual, $accpeted_statuses)) {
                $db->query('UPDATE eoi SET status = ? WHERE id = ?', [$status_change_individual, $D['id']]);
                $D['status'] = $status_change_individual;
            }
        }
    ?>


	<div class="flex flex-y eoi-front">
		<p>Applicant ID: <?= $D['user_id'] ?></p>
		<p>Job ID: <?= $D['job_id'] ?></p>
		<p>Status: <?= $D['status'] ?></p>
		<p>Desired Salary: <?= $D['desired_salary'] ?></p>
		<p>Start Date: <?= $D['start_date'] ?></p>
	</div>

    <details class="flex flex-y eoi-details">
        <!-- <summary></summary> -->
        <h2>Applicant profile</h2>
        <hr>
        
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
            <input type="hidden" name="id" value="<?=$D['id']?>">
            <input type="Submit" name="delete_individual" value="Delete">
        </form>
        <form method="POST" action="">
            <input type="hidden" name="id" value="<?=$D['id']?>">
            <input type="Submit" name="status_change" value="Change Status">
            <select name="status_change_individual">
                <option value="New">New</option>
                <option value="Current">Current</option>
                <option value="Final">Final</option>
            </select>
        </form>
    </div>


        
    </details>
</article>

