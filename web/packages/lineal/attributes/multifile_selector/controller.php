<?php namespace Concrete\Package\Lineal\Attribute\MultifileSelector {
    defined('C5_EXECUTE') or die(_("Access Denied."));

    use View;
    use Loader;

    class Controller extends \Concrete\Core\Attribute\Controller {

        protected $searchIndexFieldDefinition = array('type' => 'text', 'options' => array('length' => 4294967295, 'default' => null, 'notnull' => false));

        public function getValue() {
            $value = Loader::db()->GetOne("SELECT serializedValue FROM atMultifileSelector WHERE avID = ?", array($this->getAttributeValueID()));
            $value = (array) json_decode($value, true); // 2nd arg true means convert to array
            return $value;
        }

        public function getDisplaySanitizedValue(){
            if( is_object($this->attributeValue) ){
                $values = $this->getValue();
                if( is_array($values) && !empty($values) ){
                    return sprintf("%s Images Chosen", count($values));
                }
            }
        }

        public function searchForm($list) {
//            $list->filterByAttribute($this->attributeKey->getAttributeKeyHandle(), $this->request('value'), '=');
//            return $list;
        }

        public function search() {
            print "Search disabled for this attribute.";
        }

        public function form() {
            // Ensure file manager assets are available
            View::getInstance()->requireAsset('core/file-manager');
            // If list exists...
            if( is_object($this->attributeValue) ){
                $this->set('selectedFileIdsList', (array) $this->getAttributeValue()->getValue());
                return;
            }
            // Otherwise just pass an empty array
            $this->set('selectedFileIdsList', array());
        }

        /**
         * This doesn't seem to do anything...
         * @param $p
         * @return bool
         */
        public function validateForm($p) {
            return true;
        }

        /**
         * Save from form data.
         * @param array $data
         */
        public function saveValue( $data = array() ) {
            $serialized = array('');
            if( is_array($data) && !empty($data) ){
                $serialized = json_encode($data);
            }
            Loader::db()->Replace('atMultifileSelector', array('avID' => $this->getAttributeValueID(), 'serializedValue' => $serialized), 'avID', true);
        }

        public function deleteKey() {
            $db = Loader::db();
            $arr = $this->attributeKey->getAttributeValueIDList();
            foreach($arr as $id) {
                $db->Execute('DELETE FROM atMultifileSelector WHERE avID = ?', array($id));
            }
        }

        /**
         * The default way w/ C5 is to have the parent controller figure out exactly
         * what form data would get passed into this method via $data; but that sucks
         * for managing array form fields. So we're just going around it entirely.
         */
        public function saveForm() {
            $this->saveValue((array) $_REQUEST['_atMultifiles']);
        }

        /**
         * Remove a value...
         */
        public function deleteValue() {
            Loader::db()->Execute('DELETE FROM atMultifileSelector WHERE avID = ?', array($this->getAttributeValueID()));
        }

    }

}