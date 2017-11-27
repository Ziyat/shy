<a href="#" class="dropdown-toggle lang_dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="text-transform: uppercase;"><?= $current->url ?></a>
<ul class="dropdown-menu lang_inn">
    <?= $current->url == 'uz' ? '' : '<li><a href="/uz/' . $current_url . '" class="lang_dropdown_inner">UZ</a></li>' ?>
    <?= $current->url == 'ru' ? '' : '<li><a href="/ru/' . $current_url . '" class="lang_dropdown_inner">RU</a></li>' ?>
    <?= $current->url == 'en' ? '' : '<li><a href="/en/' . $current_url . '" class="lang_dropdown_inner">EN</a></li>' ?>
</ul>
