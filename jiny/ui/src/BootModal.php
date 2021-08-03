<?php 
namespace Jiny\UI;

/**
 * BootStrap Modal UI-Builder
 */
class BootModal
{
    public function __construct($slot=null)
    {
    }

    public function build($slot, $attrs)
    {

        $content = CDiv($slot)->addClass("modal-content");
        $dialog = CDiv()->addClass("modal-dialog")->setAttribute("role", "document");
        $modal = CDiv()->addClass("modal fade")
            ->setAttribute("tabindex", "-1")
            ->setAttribute("role", "dialog")
            ->setAttribute("aria-hidden", "true");

        if (is_object($attrs) || is_array($attrs)) {
            // 중앙 배치
            if (isset($attrs["center"])) {
                $dialog->addClass("modal-dialog-centered");
                unset($attrs["center"]);
            }

            // small modal
            if (isset($attrs["small"])) {
                $dialog->addClass("modal-sm");
                unset($attrs["small"]);
            }

            if (isset($attrs["medium"])) {
                $dialog->addClass("modal-md");
                unset($attrs["medium"]);
            }

            if (isset($attrs["large"])) {
                $dialog->addClass("modal-lg");
                unset($attrs["large"]);
            }

            if (isset($attrs["extra"])) {
                $dialog->addClass("modal-xl");
                unset($attrs["extra"]);
            }

            if (isset($attrs["fullscreen"])) {
                $dialog->addClass("modal-fullscreen");
                unset($attrs["fullscreen"]);
            }

            if (isset($attrs["scroll"])) {
                $dialog->addClass("modal-dialog-scrollable");
                unset($attrs["scroll"]);
            }




            // static
            if (isset($attrs["static"])) {
                $modal->setAttribute("data-bs-backdrop", "static");
                unset($attrs["static"]);
            }

            // modal div
            foreach($attrs as $name => $value) {
                if ($name === "class") {
                    $modal->addClass($value);
                    continue;
                }
                $modal->setAttribute($name, $value);
            }
        
        }

        $dialog->addItem($content);
        $modal->addItem($dialog);

        return $modal;
    }







}