<?php /*
*  Created by Cody Hillyard 6/19/2013 codyhillyard@gmail.com
*	$users = users that will be displayed (and array of users)
*/?>
<link href="/css/user.css" rel="stylesheet" type="text/css" />
<div id="admindiv">
<table id="usertable" >
<tr>
<th>Username</th>
<th>ID</th>
<th>oid</th>
<th>use rma</th>
<th>s rma</th>
<th>e rma</th>
<th>use lc</th>
<th>edit lc</th>
<th>use admin</th>
<th>admin s</th>
<th>admin r</th>
</tr>
<?php foreach ($users as $user){?>
<tr>
<td><?php echo $user['email'];?></td>
<td><?php echo $user['id'];?></td>
<td><?php echo $user['old_id'];?></td>
<td><?php echo $user['use_rma'];?></td>
<td><?php echo $user['search_rma'];?></td>
<td><?php echo $user['edit_rma'];?></td>
<td><?php echo $user['use_lc'];?></td>
<td><?php echo $user['edit_lc'];?></td>
<td><?php echo $user['use_admin'];?></td>
<td><?php echo $user['admin_search'];?></td>
<td><?php echo $user['admin_report'];?></td>
</tr>
<?php }?>
</table>
</div>
