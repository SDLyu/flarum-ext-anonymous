<?php namespace Sdlyu\Anonymous\Listeners;

use DirectoryIterator;
use Flarum\Event\ConfigureLocales;
use Flarum\Event\ConfigureClientView;
use Illuminate\Contracts\Events\Dispatcher;

class AddClientAssets
{
    public function subscribe(Dispatcher $events)
    {
        $events->listen(ConfigureLocales::class, [$this, 'addLocale']);
        $events->listen(ConfigureClientView::class, [$this, 'addForumAssets']);
        $events->listen(ConfigureClientView::class, [$this, 'addAdminAssets']);
    }

    public function addForumAssets(ConfigureClientView $event)
    {
        if ($event->isForum()) {
            $event->addAssets([
                __DIR__ . '/../../less/forum/extension.less',
                __DIR__ . '/../../js/forum/dist/extension.js'
            ]);
            $event->addBootstrapper('sdlyu/anonymous/main');
        }
    }

    public function addAdminAssets(ConfigureClientView $event)
    {
        if ($event->isAdmin()) {
            $event->addAssets([
                __DIR__ . '/../../less/admin/extension.less',
                __DIR__ . '/../../js/admin/dist/extension.js'
            ]);
            $event->addBootstrapper('sdlyu/anonymous/main');
        }
    }

    public function addLocale(ConfigureLocales $event)
    {
        foreach (new DirectoryIterator(__DIR__.'/../../locale') as $file) {
            if ($file->isFile() && in_array($file->getExtension(), ['yml', 'yaml'])) {
                $event->locales->addTranslations($file->getBasename('.'.$file->getExtension()), $file->getPathname());
            }
        }
    }
}
