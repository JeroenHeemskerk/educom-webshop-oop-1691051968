<?php 

require_once "BasicDoc.php";

abstract class FormsDoc extends BasicDoc {

    private function getValue($error_key) {
        return $this->getArrayValue($this->data["values"], $error_key);
    }
    private function getError($error_key) {
        return $this->getArrayValue($this->data["errors"], $error_key);
    }
    private function showFormError($error_key) {
        if (empty($this->getError($error_key))) {
            return '';
        }
        else {
            return '<span class="error">* ' .$this->getError($error_key).'</span>';
        }
    }
    protected function showFormStart() {
        echo '<form action="index.php" method="POST">';
        echo $this->showFormError("generic");
    }
    protected function showFormField($field_name, $label, $type, $error_key, $options=NULL) {
        switch ($type) {
            case "select":
                echo '<label for="'.$field_name.'">'.$label.'</label>';
                echo '<select name="'.$field_name.'">';
                foreach ($options as $option) {
                    echo '<option value="'.$option.'">'.$option.'</option>';
                }
                echo '</select>';
                echo $this->showFormError($error_key);
                break;
            case "radio":
                echo '<fieldset>';
                echo '<legend>'.$label.'</legend>';
                foreach ($options as $option) {
                    echo '<div class="radio_btn">';
                    echo '<input type="'.$type.'" name="'.$field_name.'" value="'.$option.'">';
                    echo '<label for="'.$option.'">'.$option.'</label>';
                    echo '</div>';
                }
                echo '</fieldset>';
                echo $this->showFormError($error_key);
                break;
            case "textarea":
                echo '<label for="'.$field_name.'">'.$label.'</label>';
                echo '<textarea cols="30" rows="10" value=""></textarea>';
                echo $this->showFormError($error_key);
                break;
            default:
                echo '<label for="'.$field_name.'">'.$label.'</label>';
                echo '<input type="'.$type.'" name="'.$field_name.'" value="'.$this->getValue($field_name).'">';
                echo $this->showFormError($error_key);
        }
    }
    protected function showFormEnd($page_name, $submit_text) {
        echo '<input type="hidden" name="page" value="'.$page_name.'">';
        echo '<input class="submit" type="submit" value="'.$submit_text.'">';
        echo '</form>';
    }
    abstract protected function showForm();
}