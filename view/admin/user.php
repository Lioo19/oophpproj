<?php
if (!$res) {
    return;
}
?>

<table>
    <tr class="first">
        <th>Användarnamn</th>
        <th>Namn</th>
        <th>Email</th>
        <th>Admin</th>
        <th>Created</th>
        <th>Deleted</th>
    </tr>
<?php $id = -1; foreach ($res as $row) :
    $id++; ?>
    <tr>
        <td><?= $row->username ?></td>
        <td><?= $row->name ?></td>
        <td><?= $row->email ?></td>
        <td><?= $row->admin ?></td>
        <td><?= $row->created ?></td>
        <td><?= $row->deleted ?></td>
    </tr>
<?php endforeach; ?>
</table>
