<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "purchase_order".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $origin
 * @property integer $journal_id
 * @property string $date_order
 * @property integer $partner_id
 * @property integer $dest_address_id
 * @property integer $fiscal_position
 * @property string $amount_untaxed
 * @property integer $location_id
 * @property integer $company_id
 * @property string $amount_tax
 * @property string $state
 * @property integer $pricelist_id
 * @property integer $warehouse_id
 * @property integer $payment_term_id
 * @property string $partner_ref
 * @property string $date_approve
 * @property string $amount_total
 * @property string $name
 * @property string $notes
 * @property string $invoice_method
 * @property boolean $shipped
 * @property integer $validator
 * @property string $minimum_planned_date
 * @property string $subcont_type
 * @property boolean $rm_sent
 * @property string $yourref
 * @property integer $port_moved0
 * @property string $note
 * @property string $other
 * @property string $jenis
 * @property string $type_permintaan
 * @property string $no_fpb
 * @property string $duedate
 * @property string $term_of_payment
 * @property string $scheduleddate
 * @property integer $print_line
 * @property integer $attention
 * @property string $port
 * @property string $delivery
 * @property string $after_shipment
 * @property string $total_price
 * @property string $shipment_to
 *
 * @property AccountBankStatementLine[] $accountBankStatementLines
 * @property PbRel[] $pbRels
 * @property ProcurementOrder[] $procurementOrders
 * @property PurchaseInvoiceRel[] $purchaseInvoiceRels
 * @property PurchaseOrderSubcontSentLine[] $purchaseOrderSubcontSentLines
 * @property StockPicking[] $stockPickings
 * @property WizardPbRel[] $wizardPbRels
 * @property ResUsers $writeU
 * @property StockWarehouse $warehouse
 * @property ResUsers $validator0
 * @property ProductPricelist $pricelist
 * @property Port $portMoved0
 * @property AccountPaymentTerm $paymentTerm
 * @property ResPartner $partner
 * @property StockLocation $location
 * @property AccountJournal $journal
 * @property AccountFiscalPosition $fiscalPosition
 * @property ResPartner $destAddress
 * @property ResUsers $createU
 * @property ResCompany $company
 * @property ResPartner $attention0
 * @property WoRelation[] $woRelations
 * @property WizardPoCancelItem[] $wizardPoCancelItems
 * @property PurchaseOrderLineCancel[] $purchaseOrderLineCancels
 * @property PurchaseOrderLine[] $purchaseOrderLines
 * @property WizardSupplierFirstPayment[] $wizardSupplierFirstPayments
 */
class PurchaseOrder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'purchase_order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_uid', 'write_uid', 'journal_id', 'dest_address_id', 'fiscal_position', 'location_id', 'company_id', 'pricelist_id', 'warehouse_id', 'payment_term_id', 'validator', 'port_moved0', 'print_line', 'attention'], 'integer'],
            [['create_date', 'write_date', 'date_order', 'partner_id', 'date_approve', 'minimum_planned_date', 'duedate', 'scheduleddate'], 'safe'],
            [['location_id', 'company_id', 'pricelist_id', 'name', 'invoice_method', 'jenis', 'type_permintaan', 'term_of_payment'], 'required'],
            [['amount_untaxed', 'amount_tax', 'amount_total'], 'number'],
            [['state', 'notes', 'invoice_method', 'subcont_type', 'yourref', 'note', 'other', 'jenis', 'type_permintaan', 'no_fpb', 'term_of_payment', 'delivery', 'after_shipment', 'total_price', 'shipment_to'], 'string'],
            [['shipped', 'rm_sent'], 'boolean'],
            [['origin', 'partner_ref', 'name'], 'string', 'max' => 64],
            [['port'], 'string', 'max' => 128],
            [['name', 'company_id'], 'unique', 'targetAttribute' => ['name', 'company_id'], 'message' => 'The combination of Company ID and Name has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'create_uid' => 'Create Uid',
            'create_date' => 'Create Date',
            'write_date' => 'Write Date',
            'write_uid' => 'Write Uid',
            'origin' => 'Origin',
            'journal_id' => 'Journal ID',
            'date_order' => 'Date Order',
            'partner_id' => 'Supplier',
            'dest_address_id' => 'Dest Address ID',
            'fiscal_position' => 'Fiscal Position',
            'amount_untaxed' => 'Amount Untaxed',
            'location_id' => 'Location ID',
            'company_id' => 'Company ID',
            'amount_tax' => 'Amount Tax',
            'state' => 'State',
            'pricelist_id' => 'Pricelist ID',
            'warehouse_id' => 'Warehouse ID',
            'payment_term_id' => 'Payment Term ID',
            'partner_ref' => 'Partner Ref',
            'date_approve' => 'Date Approve',
            'amount_total' => 'Amount Total',
            'name' => 'Name',
            'notes' => 'Notes',
            'invoice_method' => 'Invoice Method',
            'shipped' => 'Shipped',
            'validator' => 'Validator',
            'minimum_planned_date' => 'Minimum Planned Date',
            'subcont_type' => 'Subcont Type',
            'rm_sent' => 'Rm Sent',
            'yourref' => 'Yourref',
            'port_moved0' => 'Port Moved0',
            'note' => 'Note',
            'other' => 'Other',
            'jenis' => 'Jenis',
            'type_permintaan' => 'Type Permintaan',
            'no_fpb' => 'No Fpb',
            'duedate' => 'Duedate',
            'term_of_payment' => 'Term Of Payment',
            'scheduleddate' => 'Scheduleddate',
            'print_line' => 'Print Line',
            'attention' => 'Attention',
            'port' => 'Port',
            'delivery' => 'Delivery',
            'after_shipment' => 'After Shipment',
            'total_price' => 'Total Price',
            'shipment_to' => 'Shipment To',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountBankStatementLines()
    {
        return $this->hasMany(AccountBankStatementLine::className(), ['po_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPbRels()
    {
        return $this->hasMany(PbRel::className(), ['line_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcurementOrders()
    {
        return $this->hasMany(ProcurementOrder::className(), ['purchase_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseInvoiceRels()
    {
        return $this->hasMany(PurchaseInvoiceRel::className(), ['purchase_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrderSubcontSentLines()
    {
        return $this->hasMany(PurchaseOrderSubcontSentLine::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockPickings()
    {
        return $this->hasMany(StockPicking::className(), ['purchase_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardPbRels()
    {
        return $this->hasMany(WizardPbRel::className(), ['detail_pb_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWriteU()
    {
        return $this->hasOne(ResUsers::className(), ['id' => 'write_uid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehouse()
    {
        return $this->hasOne(StockWarehouse::className(), ['id' => 'warehouse_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getValidator0()
    {
        return $this->hasOne(ResUsers::className(), ['id' => 'validator']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPricelist()
    {
        return $this->hasOne(ProductPricelist::className(), ['id' => 'pricelist_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPortMoved0()
    {
        return $this->hasOne(Port::className(), ['id' => 'port_moved0']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentTerm()
    {
        return $this->hasOne(AccountPaymentTerm::className(), ['id' => 'payment_term_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartner()
    {
        return $this->hasOne(ResPartner::className(), ['id' => 'partner_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocation()
    {
        return $this->hasOne(StockLocation::className(), ['id' => 'location_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJournal()
    {
        return $this->hasOne(AccountJournal::className(), ['id' => 'journal_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFiscalPosition()
    {
        return $this->hasOne(AccountFiscalPosition::className(), ['id' => 'fiscal_position']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDestAddress()
    {
        return $this->hasOne(ResPartner::className(), ['id' => 'dest_address_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreateU()
    {
        return $this->hasOne(ResUsers::className(), ['id' => 'create_uid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(ResCompany::className(), ['id' => 'company_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttention0()
    {
        return $this->hasOne(ResPartner::className(), ['id' => 'attention']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWoRelations()
    {
        return $this->hasMany(WoRelation::className(), ['production_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardPoCancelItems()
    {
        return $this->hasMany(WizardPoCancelItem::className(), ['po_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrderLineCancels()
    {
        return $this->hasMany(PurchaseOrderLineCancel::className(), ['po_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrderLines()
    {
        // return $this->hasMany(PurchaseOrderLine::className(), ['order_id' => 'id']);
        return $this->hasMany(PurchaseOrderLine::className(), ['order_id' => 'id'])->orderBy('no, id ASC');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardSupplierFirstPayments()
    {
        return $this->hasMany(WizardSupplierFirstPayment::className(), ['po_id' => 'id']);
    }
}
