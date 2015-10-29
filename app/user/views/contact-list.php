<table>
    <tbody>
        <?php foreach ($d as $key => $user): ?>
        <tr >
            <td class="padv-2 padh-3"><?php
            $c->service("userImg", ["id" => $user["id"]], "user-img-xs pull-left marg-right-5 marg-top-5"); ?></td>
            <td class="padv-2"><strong class="block"><?php
                echo $user["UserLastname"] ?>
                <?php
                echo $user["UserFirstname"] ?></strong>
                <span class="small opacity"><?php echo $user["UserRole"]; ?></span>
                </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>