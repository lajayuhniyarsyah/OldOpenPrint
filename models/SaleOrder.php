<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sale_order".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $origin
 * @property string $order_policy
 * @property integer $shop_id
 * @property string $client_order_ref
 * @property string $date_order
 * @property integer $partner_id
 * @property string $note
 * @property integer $fiscal_position
 * @property integer $user_id
 * @property integer $payment_term
 * @property integer $company_id
 * @property string $amount_tax
 * @property string $state
 * @property integer $pricelist_id
 * @property integer $partner_invoice_id
 * @property string $amount_untaxed
 * @property string $date_confirm
 * @property string $amount_total
 * @property integer $project_id
 * @property string $name
 * @property integer $partner_shipping_id
 * @property string $invoice_quantity
 * @property string $picking_policy
 * @property integer $incoterm
 * @property boolean $shipped
 * @property integer $carrier_id
 * @property string $worktype
 * @property string $delivery_date
 * @property integer $week
 * @property boolean $sow12
 * @property boolean $sow11
 * @property boolean $sowC
 * @property boolean $sowA
 * @property boolean $sow9
 * @property boolean $sow8
 * @property boolean $sow3
 * @property boolean $sow2
 * @property boolean $sow1
 * @property boolean $sow7
 * @property boolean $sow6
 * @property boolean $sow5
 * @property boolean $sow4
 * @property boolean $sowB
 * @property boolean $sow14
 * @property boolean $sow13
 * @property boolean $sow10
 * @property boolean $kondisi3
 * @property boolean $kondisi2
 * @property boolean $kondisi1
 * @property string $attention_moved0
 * @property integer $attention
 * @property string $internal_notes
 * @property string $due_date
 *
 * @property ScopeWorkCustomerRel[] $scopeWorkCustomerRels
 * @property ScopeWorkSupraRel[] $scopeWorkSupraRels
 * @property TermConditionRel[] $termConditionRels
 * @property SaleOrderInvoiceRel[] $saleOrderInvoiceRels
 * @property ResPartner $attention0
 * @property DeliveryCarrier $carrier
 * @property StockIncoterms $incoterm0
 * @property ResPartner $partnerInvoice
 * @property SaleShop $shop
 * @property AccountAnalyticAccount $project
 * @property ResPartner $partnerShipping
 * @property ResPartner $partner
 * @property AccountFiscalPosition $fiscalPosition
 * @property AccountPaymentTerm $paymentTerm
 * @property ProductPricelist $pricelist
 * @property ResUsers $user
 * @property ResUsers $writeU
 * @property ResUsers $createU
 * @property StockPicking[] $stockPickings
 * @property SaleOrderLine[] $saleOrderLines
 * @property SaleLineRel[] $saleLineRels
 * @property MrpProduction[] $mrpProductions
 * @property OrderPreparation[] $orderPreparations
 * @property BeforeActualSenin[] $beforeActualSenins
 * @property AfterActualSenin[] $afterActualSenins
 * @property BeforePlanSelasa[] $beforePlanSelasas
 * @property AfterPlanSenin[] $afterPlanSenins
 * @property BeforePlanSenin[] $beforePlanSenins
 * @property AfterActualSelasa[] $afterActualSelasas
 * @property AfterPlanRabu[] $afterPlanRabus
 * @property BeforeActualRabu[] $beforeActualRabus
 * @property AfterActualRabu[] $afterActualRabus
 * @property AfterPlanKamis[] $afterPlanKamis
 * @property BeforePlanKamis[] $beforePlanKamis
 * @property BeforePlanRabu[] $beforePlanRabus
 * @property BeforeActualJumat[] $beforeActualJumats
 * @property AfterActualJumat[] $afterActualJumats
 * @property AfterPlanJumat[] $afterPlanJumats
 * @property WizardBeforeActualSenin[] $wizardBeforeActualSenins
 * @property WizardBeforePlanSenin[] $wizardBeforePlanSenins
 * @property WizardAfterPlanSenin[] $wizardAfterPlanSenins
 * @property BeforePlanJumat[] $beforePlanJumats
 * @property WizardAfterActualRabu[] $wizardAfterActualRabus
 * @property WizardBeforeActualRabu[] $wizardBeforeActualRabus
 * @property WizardAfterPlanSelasa[] $wizardAfterPlanSelasas
 * @property WizardAfterPlanRabu[] $wizardAfterPlanRabus
 * @property WizardBeforeActualSelasa[] $wizardBeforeActualSelasas
 * @property WizardAfterActualSelasa[] $wizardAfterActualSelasas
 * @property WizardBeforePlanRabu[] $wizardBeforePlanRabus
 * @property BeforeActualKamis[] $beforeActualKamis
 * @property BeforeActualSelasa[] $beforeActualSelasas
 * @property AfterActualKamis[] $afterActualKamis
 * @property WeekStatusLine[] $weekStatusLines
 * @property AfterPlanSelasa[] $afterPlanSelasas
 * @property WizardAfterActualJumat[] $wizardAfterActualJumats
 * @property WizardBeforePlanJumat[] $wizardBeforePlanJumats
 * @property WizardAfterPlanJumat[] $wizardAfterPlanJumats
 * @property WizardBeforeActualJumat[] $wizardBeforeActualJumats
 * @property WizardAfterActualKamis[] $wizardAfterActualKamis
 * @property WizardBeforeActualKamis[] $wizardBeforeActualKamis
 * @property AfterPlanAhad[] $afterPlanAhads
 * @property BeforePlanAhad[] $beforePlanAhads
 * @property AfterActualSabtu[] $afterActualSabtus
 * @property BeforeActualSabtu[] $beforeActualSabtus
 * @property WizardBeforeActualAhad[] $wizardBeforeActualAhads
 * @property WizardAfterActualSenin[] $wizardAfterActualSenins
 * @property WizardAfterPlanSabtu[] $wizardAfterPlanSabtus
 * @property WizardBeforeActualSabtu[] $wizardBeforeActualSabtus
 * @property WizardAfterActualSabtu[] $wizardAfterActualSabtus
 * @property WizardBeforePlanAhad[] $wizardBeforePlanAhads
 * @property WizardAfterPlanAhad[] $wizardAfterPlanAhads
 * @property WizardBeforePlanSelasa[] $wizardBeforePlanSelasas
 * @property WizardBeforePlanKamis[] $wizardBeforePlanKamis
 * @property WizardBeforePlanSabtu[] $wizardBeforePlanSabtus
 * @property WizardAfterPlanKamis[] $wizardAfterPlanKamis
 * @property WizardAfterActualAhad[] $wizardAfterActualAhads
 * @property LogActivity[] $logActivities
 * @property BeforePlanSabtu[] $beforePlanSabtus
 * @property AfterPlanSabtu[] $afterPlanSabtus
 * @property BeforeActualAhad[] $beforeActualAhads
 * @property AfterActualAhad[] $afterActualAhads
 * @property PerintahKerja[] $perintahKerjas
 * @property RemainderSalesman[] $remainderSalesmen
 */
class SaleOrder extends \yii\db\ActiveRecord
{

    private static $state_aliases = [
        'draft'=>'Draft',
        'sent'=>'Quotation Sent',
        'cancel'=>'Cancelled',
        'waiting_date'=>'waiting Schedule',
        'progress'=>'Sale Order',
        'manual'=>'Sale to Invoice',
        'shipping_except'=>'Shipping Exception',
        'invoice_except'=>'Invoice Exception',
        'done'=>'Done',
    ];

    public static function getStateAliases(){
        return self::$state_aliases;
    }
    public static function getStateAlias($index){
        return self::$state_aliases[$index];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sale_order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_uid', 'write_uid', 'shop_id', 'partner_id', 'fiscal_position', 'user_id', 'payment_term', 'company_id', 'pricelist_id', 'partner_invoice_id', 'project_id', 'partner_shipping_id', 'incoterm', 'carrier_id', 'week', 'attention'], 'integer'],
            [['create_date', 'write_date', 'date_order', 'date_confirm', 'delivery_date', 'due_date'], 'safe'],
            [['order_policy', 'shop_id', 'date_order', 'partner_id', 'pricelist_id', 'partner_invoice_id', 'name', 'partner_shipping_id', 'invoice_quantity', 'picking_policy'], 'required'],
            [['order_policy', 'note', 'state', 'invoice_quantity', 'picking_policy', 'worktype', 'internal_notes'], 'string'],
            [['amount_tax', 'amount_untaxed', 'amount_total'], 'number'],
            [['shipped', 'sow12', 'sow11', 'sowC', 'sowA', 'sow9', 'sow8', 'sow3', 'sow2', 'sow1', 'sow7', 'sow6', 'sow5', 'sow4', 'sowB', 'sow14', 'sow13', 'sow10', 'kondisi3', 'kondisi2', 'kondisi1'], 'boolean'],
            [['origin', 'client_order_ref', 'name', 'attention_moved0'], 'string', 'max' => 64],
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
            'order_policy' => 'Order Policy',
            'shop_id' => 'Shop ID',
            'client_order_ref' => 'Client Order Ref',
            'date_order' => 'Date Order',
            'partner_id' => 'Partner ID',
            'note' => 'Note',
            'fiscal_position' => 'Fiscal Position',
            'user_id' => 'User ID',
            'payment_term' => 'Payment Term',
            'company_id' => 'Company ID',
            'amount_tax' => 'Amount Tax',
            'state' => 'State',
            'pricelist_id' => 'Pricelist ID',
            'partner_invoice_id' => 'Partner Invoice ID',
            'amount_untaxed' => 'Amount Untaxed',
            'date_confirm' => 'Date Confirm',
            'amount_total' => 'Amount Total',
            'project_id' => 'Project ID',
            'name' => 'Name',
            'partner_shipping_id' => 'Partner Shipping ID',
            'invoice_quantity' => 'Invoice Quantity',
            'picking_policy' => 'Picking Policy',
            'incoterm' => 'Incoterm',
            'shipped' => 'Shipped',
            'carrier_id' => 'Carrier ID',
            'worktype' => 'Worktype',
            'delivery_date' => 'Delivery Date',
            'week' => 'Week',
            'sow12' => 'Sow12',
            'sow11' => 'Sow11',
            'sowC' => 'Sow C',
            'sowA' => 'Sow A',
            'sow9' => 'Sow9',
            'sow8' => 'Sow8',
            'sow3' => 'Sow3',
            'sow2' => 'Sow2',
            'sow1' => 'Sow1',
            'sow7' => 'Sow7',
            'sow6' => 'Sow6',
            'sow5' => 'Sow5',
            'sow4' => 'Sow4',
            'sowB' => 'Sow B',
            'sow14' => 'Sow14',
            'sow13' => 'Sow13',
            'sow10' => 'Sow10',
            'kondisi3' => 'Kondisi3',
            'kondisi2' => 'Kondisi2',
            'kondisi1' => 'Kondisi1',
            'attention_moved0' => 'Attention Moved0',
            'attention' => 'Attention',
            'internal_notes' => 'Internal Notes',
            'due_date' => 'Due Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScopeWorkCustomerRels()
    {
        return $this->hasMany(ScopeWorkCustomerRel::className(), ['scope_customer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScopeWorkSupraRels()
    {
        return $this->hasMany(ScopeWorkSupraRel::className(), ['scope_supra_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTermConditionRels()
    {
        return $this->hasMany(TermConditionRel::className(), ['term_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleOrderInvoiceRels()
    {
        return $this->hasMany(SaleOrderInvoiceRel::className(), ['order_id' => 'id']);
    }

    public function getInvoices(){
        return $this->hasMany(AccountInvoice::className(),['id'=>'invoice_id'])->via('saleOrderInvoiceRels');
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
    public function getCarrier()
    {
        return $this->hasOne(DeliveryCarrier::className(), ['id' => 'carrier_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIncoterm0()
    {
        return $this->hasOne(StockIncoterms::className(), ['id' => 'incoterm']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartnerInvoice()
    {
        return $this->hasOne(ResPartner::className(), ['id' => 'partner_invoice_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShop()
    {
        return $this->hasOne(SaleShop::className(), ['id' => 'shop_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(AccountAnalyticAccount::className(), ['id' => 'project_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartnerShipping()
    {
        return $this->hasOne(ResPartner::className(), ['id' => 'partner_shipping_id']);
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
    public function getFiscalPosition()
    {
        return $this->hasOne(AccountFiscalPosition::className(), ['id' => 'fiscal_position']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentTerm()
    {
        return $this->hasOne(AccountPaymentTerm::className(), ['id' => 'payment_term']);
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
    public function getUser()
    {
        return $this->hasOne(ResUsers::className(), ['id' => 'user_id']);
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
    public function getCreateU()
    {
        return $this->hasOne(ResUsers::className(), ['id' => 'create_uid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockPickings()
    {
        return $this->hasMany(StockPicking::className(), ['sale_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleOrderLines()
    {
        return $this->hasMany(SaleOrderLine::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleLineRels()
    {
        return $this->hasMany(SaleLineRel::className(), ['sale_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrpProductions()
    {
        return $this->hasMany(MrpProduction::className(), ['sale_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderPreparations()
    {
        return $this->hasMany(OrderPreparation::className(), ['sale_id' => 'id']);
    }



    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforeActualSenins()
    {
        return $this->hasMany(BeforeActualSenin::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterActualSenins()
    {
        return $this->hasMany(AfterActualSenin::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforePlanSelasas()
    {
        return $this->hasMany(BeforePlanSelasa::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterPlanSenins()
    {
        return $this->hasMany(AfterPlanSenin::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforePlanSenins()
    {
        return $this->hasMany(BeforePlanSenin::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterActualSelasas()
    {
        return $this->hasMany(AfterActualSelasa::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterPlanRabus()
    {
        return $this->hasMany(AfterPlanRabu::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforeActualRabus()
    {
        return $this->hasMany(BeforeActualRabu::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterActualRabus()
    {
        return $this->hasMany(AfterActualRabu::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterPlanKamis()
    {
        return $this->hasMany(AfterPlanKamis::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforePlanKamis()
    {
        return $this->hasMany(BeforePlanKamis::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforePlanRabus()
    {
        return $this->hasMany(BeforePlanRabu::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforeActualJumats()
    {
        return $this->hasMany(BeforeActualJumat::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterActualJumats()
    {
        return $this->hasMany(AfterActualJumat::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterPlanJumats()
    {
        return $this->hasMany(AfterPlanJumat::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforeActualSenins()
    {
        return $this->hasMany(WizardBeforeActualSenin::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforePlanSenins()
    {
        return $this->hasMany(WizardBeforePlanSenin::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterPlanSenins()
    {
        return $this->hasMany(WizardAfterPlanSenin::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforePlanJumats()
    {
        return $this->hasMany(BeforePlanJumat::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterActualRabus()
    {
        return $this->hasMany(WizardAfterActualRabu::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforeActualRabus()
    {
        return $this->hasMany(WizardBeforeActualRabu::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterPlanSelasas()
    {
        return $this->hasMany(WizardAfterPlanSelasa::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterPlanRabus()
    {
        return $this->hasMany(WizardAfterPlanRabu::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforeActualSelasas()
    {
        return $this->hasMany(WizardBeforeActualSelasa::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterActualSelasas()
    {
        return $this->hasMany(WizardAfterActualSelasa::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforePlanRabus()
    {
        return $this->hasMany(WizardBeforePlanRabu::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforeActualKamis()
    {
        return $this->hasMany(BeforeActualKamis::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforeActualSelasas()
    {
        return $this->hasMany(BeforeActualSelasa::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterActualKamis()
    {
        return $this->hasMany(AfterActualKamis::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWeekStatusLines()
    {
        return $this->hasMany(WeekStatusLine::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterPlanSelasas()
    {
        return $this->hasMany(AfterPlanSelasa::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterActualJumats()
    {
        return $this->hasMany(WizardAfterActualJumat::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforePlanJumats()
    {
        return $this->hasMany(WizardBeforePlanJumat::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterPlanJumats()
    {
        return $this->hasMany(WizardAfterPlanJumat::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforeActualJumats()
    {
        return $this->hasMany(WizardBeforeActualJumat::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterActualKamis()
    {
        return $this->hasMany(WizardAfterActualKamis::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforeActualKamis()
    {
        return $this->hasMany(WizardBeforeActualKamis::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterPlanAhads()
    {
        return $this->hasMany(AfterPlanAhad::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforePlanAhads()
    {
        return $this->hasMany(BeforePlanAhad::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterActualSabtus()
    {
        return $this->hasMany(AfterActualSabtu::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforeActualSabtus()
    {
        return $this->hasMany(BeforeActualSabtu::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforeActualAhads()
    {
        return $this->hasMany(WizardBeforeActualAhad::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterActualSenins()
    {
        return $this->hasMany(WizardAfterActualSenin::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterPlanSabtus()
    {
        return $this->hasMany(WizardAfterPlanSabtu::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforeActualSabtus()
    {
        return $this->hasMany(WizardBeforeActualSabtu::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterActualSabtus()
    {
        return $this->hasMany(WizardAfterActualSabtu::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforePlanAhads()
    {
        return $this->hasMany(WizardBeforePlanAhad::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterPlanAhads()
    {
        return $this->hasMany(WizardAfterPlanAhad::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforePlanSelasas()
    {
        return $this->hasMany(WizardBeforePlanSelasa::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforePlanKamis()
    {
        return $this->hasMany(WizardBeforePlanKamis::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforePlanSabtus()
    {
        return $this->hasMany(WizardBeforePlanSabtu::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterPlanKamis()
    {
        return $this->hasMany(WizardAfterPlanKamis::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterActualAhads()
    {
        return $this->hasMany(WizardAfterActualAhad::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogActivities()
    {
        return $this->hasMany(LogActivity::className(), ['quotation_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforePlanSabtus()
    {
        return $this->hasMany(BeforePlanSabtu::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterPlanSabtus()
    {
        return $this->hasMany(AfterPlanSabtu::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforeActualAhads()
    {
        return $this->hasMany(BeforeActualAhad::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterActualAhads()
    {
        return $this->hasMany(AfterActualAhad::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerintahKerjas()
    {
        return $this->hasMany(PerintahKerja::className(), ['sale_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRemainderSalesmen()
    {
        return $this->hasMany(RemainderSalesman::className(), ['order_id' => 'id']);
    }

    /**
     * @return Delivery Note
     */
    
    public function getDeliveryNotes(){
        return $this->hasMany(DeliveryNote::className(),['prepare_id'=>'id'])->via('orderPreparations');
    }


}
