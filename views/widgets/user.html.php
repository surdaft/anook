<div class="anook-widget user">
    <div class="top-logo">
        Anook Profile
        <img src="<?= plugins_url('anook/images/logo/light-icon.png') ?>">
    </div>
    <div class="profile">
        <div class="profile-picture">
            <img src="<?= $anook_user->picture ?>" />
        </div>
        <div class="profile-information">
            <span class="username"><?= $anook_user->username ?></span>
            <span class="age-location"><?= $anook_user->age ?>, <?= $anook_user->country ?></span>
        </div>
        <a class="button follow-button" href="https://www.anook.com/<?= $anook_user->username ?>?rel=surdaft/anook">Follow</a>
    </div>
</div>