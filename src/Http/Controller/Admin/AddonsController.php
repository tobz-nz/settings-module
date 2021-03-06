<?php namespace Anomaly\SettingsModule\Http\Controller\Admin;

use Anomaly\SettingsModule\Setting\Form\SettingFormBuilder;
use Anomaly\SettingsModule\Setting\Table\AddonTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

/**
 * Class AddonsController
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\SettingsModule\Http\Controller\Admin
 */
class AddonsController extends AdminController
{

    /**
     * Return an index of addons with settings.
     *
     * @param AddonTableBuilder $table
     * @param                   $type
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(AddonTableBuilder $table, $type)
    {
        $table->setType($type);

        return $table->render();
    }

    /**
     * Return a form for editing settings.
     *
     * @param SettingFormBuilder $form
     * @param                    $type
     * @param                    $addon
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(SettingFormBuilder $form, $type, $addon)
    {
        unset($type);

        return $form->render($addon);
    }
}
