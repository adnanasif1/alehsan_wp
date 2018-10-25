<?php
if (!defined('ABSPATH')) die('Access Denied');

class zemesMessages{

    public static function setLayoutMessage($message, $type) {
        $_SESSION['n_msg'] = $message;
        $_SESSION['n_type'] = $type;
    }

    public static function getLayoutMessage() {
        $message = '';
        if (isset($_SESSION['n_msg']) && isset($_SESSION['n_type'])) {
            $message = '<div class="' . $_SESSION['n_type'] . '"><p>' . $_SESSION['n_msg'] . '</p></div>';
        }
        echo $message;
        unset($_SESSION['n_msg']);
        unset($_SESSION['n_type']);
    }

    public static function getMessage($result, $entity_name){

        $final_message['message'] = '';
        $final_message['status'] = "updated";

        $entity_name = self::makeEntityName($entity_name);

        switch ($result) {
            case 'saved':
                $message2 = __('has been successfully saved','zem_emailsystem');
                if ($entity_name)
                    $final_message['message'] = $entity_name . ' ' . $message2;
            break;
            case 'save_error':
                $final_message['status'] = "error";
                $message2 = __('has not been saved','zem_emailsystem');
                if ($entity_name)
                    $final_message['message'] = $entity_name . ' ' . $message2;
            break;
            case 'deleted':
                $message2 = __('has been successfully deleted','zem_emailsystem');
                if ($entity_name)
                    $final_message['message'] = $entity_name . ' ' . $message2;
            break;
            case 'delete_error':
                $final_message['status'] = "error";
                $message2 = __('has not been deleted','zem_emailsystem');
                if ($entity_name){
                    $final_message['message'] = $entity_name . ' ' . $message2;
                }
            break;
            case 'orderup':
                $message2 = __('order up successfully','zem_emailsystem');
                if ($entity_name)
                    $final_message['message'] = $entity_name . ' ' . $message2;
            break;
            case 'orderdown':
                $message2 = __('order down successfully','zem_emailsystem');
                if ($entity_name)
                    $final_message['message'] = $entity_name . ' ' . $message2;
            break;
            case 'in_use':
                $final_message['status'] = "error";
                $message2 = __('in use cannot deleted','zem_emailsystem');
                if ($entity_name)
                    $final_message['message'] = $entity_name . ' ' . $message2;
            break;
            case 'already_exist':
                $final_message['status'] = "error";
                $message2 = __('already exist','zem_emailsystem');
                if ($entity_name)
                    $final_message['message'] = $entity_name . ' ' . $message2;
            break;
            case 'published':
                $message2 = __('published successfully','zem_emailsystem');
                if ($entity_name)
                    $final_message['message'] = $entity_name . ' ' . $message2;
            break;
            case 'publish_error':
                $final_message['status'] = "error";
                $final_message['message'] = zemesMessages::$counter.' '.__('Record has not been published','zem_emailsystem');
            break;
            case 'un_published':
                $message2 = __('unpublished successfully','zem_emailsystem');
                if ($entity_name)
                    $final_message['message'] = $entity_name . ' ' . $message2;
            break;
            case 'un_publish_error':
                $final_message['status'] = "error";
                $final_message['message'] = zemesMessages::$counter.' '.__('Record has not been unpublished','zem_emailsystem');
            break;
        }

        return $final_message;
    }

    static function makeEntityName($entity_name){
        switch ($entity_name) {
            case 'cashreceived':
                $name = __('Cash-in','zem_emailsystem');
                break;
            case 'customers':
                $name = __('Customer','zem_emailsystem');
                break;
            case 'employees':
                $name = __('Employees','zem_emailsystem');
                break;
            case 'expenseitemnames':
                $name = __('Expense Item Name','zem_emailsystem');
                break;
            case 'expenses':
                $name = __('Expense','zem_emailsystem');
                break;
            case 'expensetypes':
                $name = __('Expense Type','zem_emailsystem');
                break;
            case 'phonebook':
                $name = __('Contact','zem_emailsystem');
                break;
            case 'purchaseitemnames':
                $name = __('Purchase Item Name','zem_emailsystem');
                break;
            case 'purchases':
                $name = __('Purchase','zem_emailsystem');
                break;
            case 'salaries':
                $name = __('Salary','zem_emailsystem');
                break;
            case 'saleitemname':
                $name = __('Sale Item Name','zem_emailsystem');
                break;
            case 'sale':
                $name = __('Sale','zem_emailsystem');
                break;
            default:
                $name = __('Unknown','zem_emailsystem');
                break;
        }
        return $name;
    }
}
?>