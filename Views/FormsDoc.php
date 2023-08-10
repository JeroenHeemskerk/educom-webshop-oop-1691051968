<?php 

require_once "BasicDoc.php";

abstract class FormsDoc extends BasicDoc {

    protected function getValue($key) {
        return $this->getArrayValue($this->data["values"], $key);
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
        echo $this->showFormError("genericErr");
    }
    protected function showFormField($field_name, $label, $type, $error_keys, $options=NULL) {
        switch ($type) {
            case "select":
                echo '<label for="'.$field_name.'">'.$label.'</label>';
                echo '<select name="'.$field_name.'">';
                foreach ($options as $option) {
                    if ($option == $this->getValue($field_name)) {
                        echo '<option value="'.$option.'" selected="selected">'.$option.'</option>';
                    }
                    else {
                        echo '<option value="'.$option.'">'.$option.'</option>';
                    }
                }
                echo '</select>';
                foreach ($error_keys as $error_key) {
                    echo $this->showFormError($error_key);
                }
                break;
            case "radio":
                echo '<fieldset>';
                echo '<legend>'.$label.'</legend>';
                foreach ($options as $option) {
                    echo '<div class="radio_btn">';
                    if ($option == $this->getValue($field_name)) {
                        echo '<input type="'.$type.'" name="'.$field_name.'" value="'.$option.'" checked="checked">';
                    }
                    else {
                        echo '<input type="'.$type.'" name="'.$field_name.'" value="'.$option.'">';
                    }
                    echo '<label for="'.$option.'">'.$option.'</label>';
                    echo '</div>';
                }
                echo '</fieldset>';
                foreach ($error_keys as $error_key) {
                    echo $this->showFormError($error_key);
                }
                break;
            case "textarea":
                echo '<label for="'.$field_name.'">'.$label.'</label>';
                echo '<textarea name="'.$field_name.'" cols="30" rows="10" value="">'.$this->getValue($field_name).'</textarea>';
                foreach ($error_keys as $error_key) {
                    echo $this->showFormError($error_key);
                }
                break;
            default:
                echo '<label for="'.$field_name.'">'.$label.'</label>';
                echo '<input type="'.$type.'" name="'.$field_name.'" value="'.$this->getValue($field_name).'">';
                foreach ($error_keys as $error_key) {
                    echo $this->showFormError($error_key);
                }
                
        }
    }
    protected function showFormEnd($page_name, $submit_text) {
        echo '<input type="hidden" name="page" value="'.$page_name.'">';
        echo '<input class="submit" type="submit" value="'.$submit_text.'">';
        echo '</form>';
    }
}