<?php

namespace EleganceCMS\DevTool\Providers;

use EleganceCMS\Base\Supports\ServiceProvider;
use EleganceCMS\DevTool\Commands\LocaleCreateCommand;
use EleganceCMS\DevTool\Commands\LocaleRemoveCommand;
use EleganceCMS\DevTool\Commands\Make\ControllerMakeCommand;
use EleganceCMS\DevTool\Commands\Make\FormMakeCommand;
use EleganceCMS\DevTool\Commands\Make\ModelMakeCommand;
use EleganceCMS\DevTool\Commands\Make\PanelSectionMakeCommand;
use EleganceCMS\DevTool\Commands\Make\RequestMakeCommand;
use EleganceCMS\DevTool\Commands\Make\RouteMakeCommand;
use EleganceCMS\DevTool\Commands\Make\SettingControllerMakeCommand;
use EleganceCMS\DevTool\Commands\Make\SettingFormMakeCommand;
use EleganceCMS\DevTool\Commands\Make\SettingMakeCommand;
use EleganceCMS\DevTool\Commands\Make\SettingRequestMakeCommand;
use EleganceCMS\DevTool\Commands\Make\TableMakeCommand;
use EleganceCMS\DevTool\Commands\PackageCreateCommand;
use EleganceCMS\DevTool\Commands\PackageMakeCrudCommand;
use EleganceCMS\DevTool\Commands\PackageRemoveCommand;
use EleganceCMS\DevTool\Commands\PluginCreateCommand;
use EleganceCMS\DevTool\Commands\PluginMakeCrudCommand;
use EleganceCMS\DevTool\Commands\RebuildPermissionsCommand;
use EleganceCMS\DevTool\Commands\TestSendMailCommand;
use EleganceCMS\DevTool\Commands\ThemeCreateCommand;
use EleganceCMS\DevTool\Commands\WidgetCreateCommand;
use EleganceCMS\DevTool\Commands\WidgetRemoveCommand;

class CommandServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->commands([
            TableMakeCommand::class,
            ControllerMakeCommand::class,
            RouteMakeCommand::class,
            RequestMakeCommand::class,
            FormMakeCommand::class,
            ModelMakeCommand::class,
            PackageCreateCommand::class,
            PackageMakeCrudCommand::class,
            PackageRemoveCommand::class,
            TestSendMailCommand::class,
            RebuildPermissionsCommand::class,
            LocaleRemoveCommand::class,
            LocaleCreateCommand::class,
        ]);

        if (version_compare(get_core_version(), '7.0.0', '>=')) {
            $this->commands([
                PanelSectionMakeCommand::class,
                SettingControllerMakeCommand::class,
                SettingRequestMakeCommand::class,
                SettingFormMakeCommand::class,
                SettingMakeCommand::class,
            ]);
        }

        if (class_exists(\EleganceCMS\PluginManagement\Providers\PluginManagementServiceProvider::class)) {
            $this->commands([
                PluginCreateCommand::class,
                PluginMakeCrudCommand::class,
            ]);
        }

        if (class_exists(\EleganceCMS\Theme\Providers\ThemeServiceProvider::class)) {
            $this->commands([
                ThemeCreateCommand::class,
            ]);
        }

        if (class_exists(\EleganceCMS\Widget\Providers\WidgetServiceProvider::class)) {
            $this->commands([
                WidgetCreateCommand::class,
                WidgetRemoveCommand::class,
            ]);
        }
    }
}
