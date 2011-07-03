<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_Invoice_Tags extends CI_Model {

	public function get_tags($invoice_id) {

		$this->db->select('GROUP_CONCAT(mcb_tags.tag) AS tags');

		$this->db->join('mcb_tags', 'mcb_tags.tag_id = mcb_invoice_tags.tag_id');

		$this->db->where('mcb_invoice_tags.invoice_id', $invoice_id);

		return $this->db->get('mcb_invoice_tags')->row()->tags;

	}

	public function save_tags($invoice_id, $tags = NULL) {

		/* Delete any existing tags for this invoice */
		$this->db->where('invoice_id', $invoice_id);

		$this->db->delete('mcb_invoice_tags');

		if ($tags) {

			$tags = explode(',', $tags);

			foreach ($tags as $tag) {

				$this->db->where('tag', trim($tag));

				$query = $this->db->get('mcb_tags');

				if (!$query->num_rows()) {

					/* New tag - insert the tag and get the tag_id */
					$db_array = array(
						'tag'	=>	trim($tag)
					);

					$this->db->insert('mcb_tags', $db_array);

					$tag_ids[] = $this->db->insert_id();

				}

				else {

					/* Existing tag - get the tag_id */
					$tag_ids[] = $query->row()->tag_id;

				}

			}

			foreach ($tag_ids as $tag_id) {

				$db_array = array(
					'invoice_id'	=>	$invoice_id,
					'tag_id'		=>	$tag_id
				);

				$this->db->insert('mcb_invoice_tags', $db_array);

			}

		}

	}

}

?>