<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "res_partner".
 *
 * @property integer $id
 * @property string $name
 * @property string $lang
 * @property integer $company_id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $comment
 * @property string $ean13
 * @property integer $color
 * @property resource $image
 * @property boolean $use_parent_address
 * @property boolean $active
 * @property string $street
 * @property boolean $supplier
 * @property string $city
 * @property integer $user_id
 * @property string $zip
 * @property integer $title
 * @property string $function
 * @property integer $country_id
 * @property integer $parent_id
 * @property boolean $employee
 * @property string $type
 * @property string $email
 * @property string $vat
 * @property string $website
 * @property string $fax
 * @property string $street2
 * @property string $phone
 * @property double $credit_limit
 * @property string $date
 * @property string $tz
 * @property boolean $customer
 * @property resource $image_medium
 * @property string $mobile
 * @property string $ref
 * @property resource $image_small
 * @property string $birthdate
 * @property boolean $is_company
 * @property integer $state_id
 * @property string $notification_email_send
 * @property boolean $opt_out
 * @property string $signup_type
 * @property string $signup_expiration
 * @property string $signup_token
 * @property string $last_reconciliation_date
 * @property double $debit_limit
 * @property string $display_name
 * @property string $npwp
 * @property string $term_payment
 *
 * @property MailFollowers[] $mailFollowers
 * @property MailComposeMessageResPartnerRel[] $mailComposeMessageResPartnerRels
 * @property ResRequest[] $resRequests
 * @property StockWarehouse[] $stockWarehouses
 * @property WizardAfterActualKamis[] $wizardAfterActualKamis
 * @property WizardAfterActualRabu[] $wizardAfterActualRabus
 * @property WizardAfterActualSabtu[] $wizardAfterActualSabtus
 * @property WizardAfterActualSelasa[] $wizardAfterActualSelasas
 * @property WizardAfterPlanKamis[] $wizardAfterPlanKamis
 * @property WizardAfterPlanRabu[] $wizardAfterPlanRabus
 * @property WizardAfterPlanSabtu[] $wizardAfterPlanSabtus
 * @property WizardAfterPlanSelasa[] $wizardAfterPlanSelasas
 * @property WizardAfterPlanSenin[] $wizardAfterPlanSenins
 * @property WizardBeforeActualAhad[] $wizardBeforeActualAhads
 * @property WizardBeforeActualJumat[] $wizardBeforeActualJumats
 * @property WizardBeforeActualKamis[] $wizardBeforeActualKamis
 * @property WizardAfterPlanJumat[] $wizardAfterPlanJumats
 * @property WizardAfterPlanAhad[] $wizardAfterPlanAhads
 * @property WizardBeforeActualSenin[] $wizardBeforeActualSenins
 * @property WizardBeforePlanAhad[] $wizardBeforePlanAhads
 * @property WizardBeforePlanJumat[] $wizardBeforePlanJumats
 * @property WizardBeforePlanKamis[] $wizardBeforePlanKamis
 * @property WizardBeforePlanRabu[] $wizardBeforePlanRabus
 * @property WizardBeforePlanSabtu[] $wizardBeforePlanSabtus
 * @property WizardBeforePlanSelasa[] $wizardBeforePlanSelasas
 * @property WizardBeforePlanSenin[] $wizardBeforePlanSenins
 * @property WizardBeforeActualSelasa[] $wizardBeforeActualSelasas
 * @property WizardBeforeActualSabtu[] $wizardBeforeActualSabtus
 * @property AccountBankStatementLine[] $accountBankStatementLines
 * @property AccountInvoice[] $accountInvoices
 * @property AccountModelLine[] $accountModelLines
 * @property AccountAssetAsset[] $accountAssetAssets
 * @property AccountPartnerReconcileProcess[] $accountPartnerReconcileProcesses
 * @property AccountMoveLine[] $accountMoveLines
 * @property AfterActualAhad[] $afterActualAhads
 * @property AfterActualJumat[] $afterActualJumats
 * @property AfterActualKamis[] $afterActualKamis
 * @property AfterActualRabu[] $afterActualRabus
 * @property AfterActualSabtu[] $afterActualSabtus
 * @property AfterActualSelasa[] $afterActualSelasas
 * @property AfterActualSenin[] $afterActualSenins
 * @property AfterPlanAhad[] $afterPlanAhads
 * @property AfterPlanJumat[] $afterPlanJumats
 * @property AfterPlanKamis[] $afterPlanKamis
 * @property AfterPlanRabu[] $afterPlanRabus
 * @property AfterPlanSabtu[] $afterPlanSabtus
 * @property AfterPlanSelasa[] $afterPlanSelasas
 * @property AfterPlanSenin[] $afterPlanSenins
 * @property BaseActionRuleLeadTest[] $baseActionRuleLeadTests
 * @property BaseActionRuleResPartnerRel[] $baseActionRuleResPartnerRels
 * @property BeforeActualAhad[] $beforeActualAhads
 * @property BeforeActualJumat[] $beforeActualJumats
 * @property BeforeActualKamis[] $beforeActualKamis
 * @property BeforeActualRabu[] $beforeActualRabus
 * @property BeforeActualSabtu[] $beforeActualSabtus
 * @property BeforeActualSelasa[] $beforeActualSelasas
 * @property BeforeActualSenin[] $beforeActualSenins
 * @property BeforePlanAhad[] $beforePlanAhads
 * @property BeforePlanJumat[] $beforePlanJumats
 * @property BeforePlanKamis[] $beforePlanKamis
 * @property BeforePlanRabu[] $beforePlanRabus
 * @property BeforePlanSabtu[] $beforePlanSabtus
 * @property BeforePlanSelasa[] $beforePlanSelasas
 * @property BeforePlanSenin[] $beforePlanSenins
 * @property CalendarEventResPartnerRel[] $calendarEventResPartnerRels
 * @property CalendarTodoResPartnerRel[] $calendarTodoResPartnerRels
 * @property CrmMeetingPartnerRel[] $crmMeetingPartnerRels
 * @property DeliveryCarrier[] $deliveryCarriers
 * @property PerintahKerja[] $perintahKerjas
 * @property DeliveryNote[] $deliveryNotes
 * @property PerintahKerjaInternal[] $perintahKerjaInternals
 * @property OrderPreparation[] $orderPreparations
 * @property PembelianBarang[] $pembelianBarangs
 * @property DetailPb[] $detailPbs
 * @property CalendarAttendee[] $calendarAttendees
 * @property ResPartnerBank[] $resPartnerBanks
 * @property HrExpenseDinas[] $hrExpenseDinas
 * @property AccountVoucher[] $accountVouchers
 * @property AccountAnalyticAccount[] $accountAnalyticAccounts
 * @property HrEmployee[] $hrEmployees
 * @property ResCompany[] $resCompanies
 * @property SaleOrder[] $saleOrders
 * @property WeekStatusLine[] $weekStatusLines
 * @property LogStatusCustomer[] $logStatusCustomers
 * @property MailComposeMessage[] $mailComposeMessages
 * @property MailMessageResPartnerRel[] $mailMessageResPartnerRels
 * @property MailNotification[] $mailNotifications
 * @property MailWizardInviteResPartnerRel[] $mailWizardInviteResPartnerRels
 * @property ManagementSummary[] $managementSummaries
 * @property ResUsers $writeU
 * @property ResUsers $user
 * @property ResPartnerTitle $title0
 * @property ResCountryState $state
 * @property ResPartner $parent
 * @property ResPartner[] $resPartners
 * @property ResUsers $createU
 * @property ResCountry $country
 * @property ResCompany $company
 * @property StockPicking[] $stockPickings
 * @property MergePickings[] $mergePickings
 * @property MailMessage[] $mailMessages
 * @property StockMove[] $stockMoves
 * @property StockLocation[] $stockLocations
 * @property PurchaseOrder[] $purchaseOrders
 * @property PortalWizardUser[] $portalWizardUsers
 * @property ProductSupplierinfo[] $productSupplierinfos
 * @property Pr[] $prs
 * @property RentRequisition[] $rentRequisitions
 * @property RemainderSalesman[] $remainderSalesmen
 * @property ResPartnerResPartnerCategoryRel[] $resPartnerResPartnerCategoryRels
 * @property SaleOrderLine[] $saleOrderLines
 * @property SaleOrderSummary[] $saleOrderSummaries
 * @property SetPo[] $setPos
 * @property WizardAfterActualJumat[] $wizardAfterActualJumats
 * @property WizardAfterActualSenin[] $wizardAfterActualSenins
 * @property WizardBeforeActualRabu[] $wizardBeforeActualRabus
 * @property WizardRentRequisitionDetail[] $wizardRentRequisitionDetails
 * @property WizardAfterActualAhad[] $wizardAfterActualAhads
 * @property ResUsers[] $resUsers
 */
class ResPartner extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'res_partner';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'notification_email_send'], 'required'],
            [['company_id', 'create_uid', 'write_uid', 'color', 'user_id', 'title', 'country_id', 'parent_id', 'state_id'], 'integer'],
            [['create_date', 'write_date', 'date', 'signup_expiration', 'last_reconciliation_date'], 'safe'],
            [['comment', 'image', 'type', 'image_medium', 'image_small', 'notification_email_send', 'signup_type', 'signup_token', 'display_name', 'term_payment'], 'string'],
            [['use_parent_address', 'active', 'supplier', 'employee', 'customer', 'is_company', 'opt_out'], 'boolean'],
            [['credit_limit', 'debit_limit'], 'number'],
            [['name', 'street', 'city', 'function', 'street2'], 'string', 'max' => 128],
            [['lang', 'website', 'fax', 'phone', 'tz', 'mobile', 'ref', 'birthdate'], 'string', 'max' => 64],
            [['ean13'], 'string', 'max' => 13],
            [['zip'], 'string', 'max' => 24],
            [['email'], 'string', 'max' => 240],
            [['vat'], 'string', 'max' => 32],
            [['npwp'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'lang' => 'Lang',
            'company_id' => 'Company ID',
            'create_uid' => 'Create Uid',
            'create_date' => 'Create Date',
            'write_date' => 'Write Date',
            'write_uid' => 'Write Uid',
            'comment' => 'Notes',
            'ean13' => 'EAN13',
            'color' => 'Color Index',
            'image' => 'Image',
            'use_parent_address' => 'Use Company Address',
            'active' => 'Active',
            'street' => 'Street',
            'supplier' => 'Supplier',
            'city' => 'City',
            'user_id' => 'Salesperson',
            'zip' => 'Zip',
            'title' => 'Title',
            'function' => 'Job Position',
            'country_id' => 'Country',
            'parent_id' => 'Related Company',
            'employee' => 'Employee',
            'type' => 'Address Type',
            'email' => 'Email',
            'vat' => 'TIN',
            'website' => 'Website',
            'fax' => 'Fax',
            'street2' => 'Street2',
            'phone' => 'Phone',
            'credit_limit' => 'Credit Limit',
            'date' => 'Date',
            'tz' => 'Timezone',
            'customer' => 'Customer',
            'image_medium' => 'Medium-sized image',
            'mobile' => 'Mobile',
            'ref' => 'Reference',
            'image_small' => 'Small-sized image',
            'birthdate' => 'Birthdate',
            'is_company' => 'Is a Company',
            'state_id' => 'State',
            'notification_email_send' => 'Receive Messages by Email',
            'opt_out' => 'Opt-Out',
            'signup_type' => 'Signup Token Type',
            'signup_expiration' => 'Signup Expiration',
            'signup_token' => 'Signup Token',
            'last_reconciliation_date' => 'Latest Full Reconciliation Date',
            'debit_limit' => 'Payable Limit',
            'display_name' => 'Name',
            'npwp' => 'No. NPWP',
            'term_payment' => 'Term Of Payment',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMailFollowers()
    {
        return $this->hasMany(MailFollowers::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMailComposeMessageResPartnerRels()
    {
        return $this->hasMany(MailComposeMessageResPartnerRel::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResRequests()
    {
        return $this->hasMany(ResRequest::className(), ['ref_partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockWarehouses()
    {
        return $this->hasMany(StockWarehouse::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterActualKamis()
    {
        return $this->hasMany(WizardAfterActualKamis::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterActualRabus()
    {
        return $this->hasMany(WizardAfterActualRabu::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterActualSabtus()
    {
        return $this->hasMany(WizardAfterActualSabtu::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterActualSelasas()
    {
        return $this->hasMany(WizardAfterActualSelasa::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterPlanKamis()
    {
        return $this->hasMany(WizardAfterPlanKamis::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterPlanRabus()
    {
        return $this->hasMany(WizardAfterPlanRabu::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterPlanSabtus()
    {
        return $this->hasMany(WizardAfterPlanSabtu::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterPlanSelasas()
    {
        return $this->hasMany(WizardAfterPlanSelasa::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterPlanSenins()
    {
        return $this->hasMany(WizardAfterPlanSenin::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforeActualAhads()
    {
        return $this->hasMany(WizardBeforeActualAhad::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforeActualJumats()
    {
        return $this->hasMany(WizardBeforeActualJumat::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforeActualKamis()
    {
        return $this->hasMany(WizardBeforeActualKamis::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterPlanJumats()
    {
        return $this->hasMany(WizardAfterPlanJumat::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterPlanAhads()
    {
        return $this->hasMany(WizardAfterPlanAhad::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforeActualSenins()
    {
        return $this->hasMany(WizardBeforeActualSenin::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforePlanAhads()
    {
        return $this->hasMany(WizardBeforePlanAhad::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforePlanJumats()
    {
        return $this->hasMany(WizardBeforePlanJumat::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforePlanKamis()
    {
        return $this->hasMany(WizardBeforePlanKamis::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforePlanRabus()
    {
        return $this->hasMany(WizardBeforePlanRabu::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforePlanSabtus()
    {
        return $this->hasMany(WizardBeforePlanSabtu::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforePlanSelasas()
    {
        return $this->hasMany(WizardBeforePlanSelasa::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforePlanSenins()
    {
        return $this->hasMany(WizardBeforePlanSenin::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforeActualSelasas()
    {
        return $this->hasMany(WizardBeforeActualSelasa::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforeActualSabtus()
    {
        return $this->hasMany(WizardBeforeActualSabtu::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountBankStatementLines()
    {
        return $this->hasMany(AccountBankStatementLine::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountInvoices()
    {
        return $this->hasMany(AccountInvoice::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountModelLines()
    {
        return $this->hasMany(AccountModelLine::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAssetAssets()
    {
        return $this->hasMany(AccountAssetAsset::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountPartnerReconcileProcesses()
    {
        return $this->hasMany(AccountPartnerReconcileProcess::className(), ['next_partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountMoveLines()
    {
        return $this->hasMany(AccountMoveLine::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterActualAhads()
    {
        return $this->hasMany(AfterActualAhad::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterActualJumats()
    {
        return $this->hasMany(AfterActualJumat::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterActualKamis()
    {
        return $this->hasMany(AfterActualKamis::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterActualRabus()
    {
        return $this->hasMany(AfterActualRabu::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterActualSabtus()
    {
        return $this->hasMany(AfterActualSabtu::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterActualSelasas()
    {
        return $this->hasMany(AfterActualSelasa::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterActualSenins()
    {
        return $this->hasMany(AfterActualSenin::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterPlanAhads()
    {
        return $this->hasMany(AfterPlanAhad::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterPlanJumats()
    {
        return $this->hasMany(AfterPlanJumat::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterPlanKamis()
    {
        return $this->hasMany(AfterPlanKamis::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterPlanRabus()
    {
        return $this->hasMany(AfterPlanRabu::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterPlanSabtus()
    {
        return $this->hasMany(AfterPlanSabtu::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterPlanSelasas()
    {
        return $this->hasMany(AfterPlanSelasa::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterPlanSenins()
    {
        return $this->hasMany(AfterPlanSenin::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseActionRuleLeadTests()
    {
        return $this->hasMany(BaseActionRuleLeadTest::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseActionRuleResPartnerRels()
    {
        return $this->hasMany(BaseActionRuleResPartnerRel::className(), ['res_partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforeActualAhads()
    {
        return $this->hasMany(BeforeActualAhad::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforeActualJumats()
    {
        return $this->hasMany(BeforeActualJumat::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforeActualKamis()
    {
        return $this->hasMany(BeforeActualKamis::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforeActualRabus()
    {
        return $this->hasMany(BeforeActualRabu::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforeActualSabtus()
    {
        return $this->hasMany(BeforeActualSabtu::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforeActualSelasas()
    {
        return $this->hasMany(BeforeActualSelasa::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforeActualSenins()
    {
        return $this->hasMany(BeforeActualSenin::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforePlanAhads()
    {
        return $this->hasMany(BeforePlanAhad::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforePlanJumats()
    {
        return $this->hasMany(BeforePlanJumat::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforePlanKamis()
    {
        return $this->hasMany(BeforePlanKamis::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforePlanRabus()
    {
        return $this->hasMany(BeforePlanRabu::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforePlanSabtus()
    {
        return $this->hasMany(BeforePlanSabtu::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforePlanSelasas()
    {
        return $this->hasMany(BeforePlanSelasa::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforePlanSenins()
    {
        return $this->hasMany(BeforePlanSenin::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCalendarEventResPartnerRels()
    {
        return $this->hasMany(CalendarEventResPartnerRel::className(), ['res_partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCalendarTodoResPartnerRels()
    {
        return $this->hasMany(CalendarTodoResPartnerRel::className(), ['res_partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCrmMeetingPartnerRels()
    {
        return $this->hasMany(CrmMeetingPartnerRel::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeliveryCarriers()
    {
        return $this->hasMany(DeliveryCarrier::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerintahKerjas()
    {
        return $this->hasMany(PerintahKerja::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeliveryNotes()
    {
        return $this->hasMany(DeliveryNote::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerintahKerjaInternals()
    {
        return $this->hasMany(PerintahKerjaInternal::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderPreparations()
    {
        return $this->hasMany(OrderPreparation::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPembelianBarangs()
    {
        return $this->hasMany(PembelianBarang::className(), ['customer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetailPbs()
    {
        return $this->hasMany(DetailPb::className(), ['customer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCalendarAttendees()
    {
        return $this->hasMany(CalendarAttendee::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResPartnerBanks()
    {
        return $this->hasMany(ResPartnerBank::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrExpenseDinas()
    {
        return $this->hasMany(HrExpenseDinas::className(), ['customer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountVouchers()
    {
        return $this->hasMany(AccountVoucher::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAnalyticAccounts()
    {
        return $this->hasMany(AccountAnalyticAccount::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrEmployees()
    {
        return $this->hasMany(HrEmployee::className(), ['address_home_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResCompanies()
    {
        return $this->hasMany(ResCompany::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleOrders()
    {
        return $this->hasMany(SaleOrder::className(), ['attention' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWeekStatusLines()
    {
        return $this->hasMany(WeekStatusLine::className(), ['name' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogStatusCustomers()
    {
        return $this->hasMany(LogStatusCustomer::className(), ['customer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMailComposeMessages()
    {
        return $this->hasMany(MailComposeMessage::className(), ['author_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMailMessageResPartnerRels()
    {
        return $this->hasMany(MailMessageResPartnerRel::className(), ['res_partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMailNotifications()
    {
        return $this->hasMany(MailNotification::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMailWizardInviteResPartnerRels()
    {
        return $this->hasMany(MailWizardInviteResPartnerRel::className(), ['res_partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManagementSummaries()
    {
        return $this->hasMany(ManagementSummary::className(), ['partner_id' => 'id']);
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
    public function getUser()
    {
        return $this->hasOne(ResUsers::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTitle0()
    {
        return $this->hasOne(ResPartnerTitle::className(), ['id' => 'title']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getState()
    {
        return $this->hasOne(ResCountryState::className(), ['id' => 'state_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(ResPartner::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResPartners()
    {
        return $this->hasMany(ResPartner::className(), ['parent_id' => 'id']);
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
    public function getCountry()
    {
        return $this->hasOne(ResCountry::className(), ['id' => 'country_id']);
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
    public function getStockPickings()
    {
        return $this->hasMany(StockPicking::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMergePickings()
    {
        return $this->hasMany(MergePickings::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMailMessages()
    {
        return $this->hasMany(MailMessage::className(), ['author_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockMoves()
    {
        return $this->hasMany(StockMove::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockLocations()
    {
        return $this->hasMany(StockLocation::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrders()
    {
        return $this->hasMany(PurchaseOrder::className(), ['attention' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPortalWizardUsers()
    {
        return $this->hasMany(PortalWizardUser::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductSupplierinfos()
    {
        return $this->hasMany(ProductSupplierinfo::className(), ['name' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrs()
    {
        return $this->hasMany(Pr::className(), ['customer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentRequisitions()
    {
        return $this->hasMany(RentRequisition::className(), ['customer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRemainderSalesmen()
    {
        return $this->hasMany(RemainderSalesman::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResPartnerResPartnerCategoryRels()
    {
        return $this->hasMany(ResPartnerResPartnerCategoryRel::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleOrderLines()
    {
        return $this->hasMany(SaleOrderLine::className(), ['address_allotment_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleOrderSummaries()
    {
        return $this->hasMany(SaleOrderSummary::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSetPos()
    {
        return $this->hasMany(SetPo::className(), ['name' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterActualJumats()
    {
        return $this->hasMany(WizardAfterActualJumat::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterActualSenins()
    {
        return $this->hasMany(WizardAfterActualSenin::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforeActualRabus()
    {
        return $this->hasMany(WizardBeforeActualRabu::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardRentRequisitionDetails()
    {
        return $this->hasMany(WizardRentRequisitionDetail::className(), ['suplier' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterActualAhads()
    {
        return $this->hasMany(WizardAfterActualAhad::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResUsers()
    {
        return $this->hasMany(ResUsers::className(), ['partner_id' => 'id']);
    }
}
