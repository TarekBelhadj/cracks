<?php
$q = 'select c.*, u.login '
        . ' from cracks c '
        . ' left join users u on u.id=c.owner '
        . ' group by c.id '
        . ' order by c.datesend desc limit 10';

$ls = $db->query($q, PDO::FETCH_ASSOC);

?><h2>
    Les dix derniers cracks !
</h2>
<ul class="flex">
    <?php foreach($ls as $l) { ?>
    <li>
        <?php displayCrack($l); ?>
    </li>
    <?php } ?>
</ul>