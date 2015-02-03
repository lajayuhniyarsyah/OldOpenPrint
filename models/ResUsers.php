<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "res_users".
 *
 * @property integer $id
 * @property boolean $active
 * @property string $login
 * @property string $password
 * @property integer $company_id
 * @property integer $partner_id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $menu_id
 * @property string $login_date
 * @property string $signature
 * @property integer $action_id
 * @property integer $alias_id
 * @property boolean $share
 * @property string $initial
 * @property integer $kelompok_id
 *
 * @property AccountAgedTrialBalance[] $accountAgedTrialBalances
 * @property AccountAnalyticCostLedgerJournalReport[] $accountAnalyticCostLedgerJournalReports
 * @property AccountAnalyticBalance[] $accountAnalyticBalances
 * @property AccountAnalyticChart[] $accountAnalyticCharts
 * @property AccountAnalyticCostLedger[] $accountAnalyticCostLedgers
 * @property AccountAnalyticInvertedBalance[] $accountAnalyticInvertedBalances
 * @property AccountAddtmplWizard[] $accountAddtmplWizards
 * @property AccountAnalyticLine[] $accountAnalyticLines
 * @property AccountAnalyticJournalReport[] $accountAnalyticJournalReports
 * @property AccountAutomaticReconcile[] $accountAutomaticReconciles
 * @property AccountAssetDepreciationLine[] $accountAssetDepreciationLines
 * @property AccountAssetCategory[] $accountAssetCategories
 * @property AccountAssetHistory[] $accountAssetHistories
 * @property AccountBalanceReport[] $accountBalanceReports
 * @property AccountBankAccountsWizard[] $accountBankAccountsWizards
 * @property AccountBankStatement[] $accountBankStatements
 * @property AccountBankStatementLine[] $accountBankStatementLines
 * @property AccountChangeCurrency[] $accountChangeCurrencies
 * @property AccountCentralJournal[] $accountCentralJournals
 * @property AccountChart[] $accountCharts
 * @property AccountCommonAccountReport[] $accountCommonAccountReports
 * @property AccountCommonJournalReport[] $accountCommonJournalReports
 * @property AccountCommonPartnerReport[] $accountCommonPartnerReports
 * @property AccountCommonReport[] $accountCommonReports
 * @property AccountMove[] $accountMoves
 * @property AccountConfigSettings[] $accountConfigSettings
 * @property AccountCashboxLine[] $accountCashboxLines
 * @property AccountFiscalPositionAccountTemplate[] $accountFiscalPositionAccountTemplates
 * @property AccountFiscalyearCloseState[] $accountFiscalyearCloseStates
 * @property AccountFiscalPositionTaxTemplate[] $accountFiscalPositionTaxTemplates
 * @property AccountFiscalPositionTax[] $accountFiscalPositionTaxes
 * @property AccountFiscalPositionTaxGlobal[] $accountFiscalPositionTaxGlobals
 * @property AccountFiscalPositionTemplate[] $accountFiscalPositionTemplates
 * @property AccountFiscalyearClose[] $accountFiscalyearCloses
 * @property AccountFiscalyear[] $accountFiscalyears
 * @property AccountGeneralJournal[] $accountGeneralJournals
 * @property AccountMoveLine[] $accountMoveLines
 * @property AccountFiscalPosition[] $accountFiscalPositions
 * @property AccountInvoiceCancel[] $accountInvoiceCancels
 * @property AccountInvoiceConfirm[] $accountInvoiceConfirms
 * @property AccountInvoiceRefund[] $accountInvoiceRefunds
 * @property AccountJournalCashboxLine[] $accountJournalCashboxLines
 * @property AccountInstaller[] $accountInstallers
 * @property AccountJournalSelect[] $accountJournalSelects
 * @property AccountModel[] $accountModels
 * @property AccountMoveBankReconcile[] $accountMoveBankReconciles
 * @property AccountMoveLineReconcileWriteoff[] $accountMoveLineReconcileWriteoffs
 * @property AccountMoveLineReconcileSelect[] $accountMoveLineReconcileSelects
 * @property AccountMoveLineReconcile[] $accountMoveLineReconciles
 * @property AccountMoveLineUnreconcileSelect[] $accountMoveLineUnreconcileSelects
 * @property AccountOpenClosedFiscalyear[] $accountOpenClosedFiscalyears
 * @property AccountMoveReconcile[] $accountMoveReconciles
 * @property AccountPartnerBalance[] $accountPartnerBalances
 * @property AccountPartnerLedger[] $accountPartnerLedgers
 * @property AccountPrintJournal[] $accountPrintJournals
 * @property AccountPeriodClose[] $accountPeriodCloses
 * @property AccountSequenceFiscalyear[] $accountSequenceFiscalyears
 * @property AccountReportGeneralLedger[] $accountReportGeneralLedgers
 * @property AccountSubscriptionLine[] $accountSubscriptionLines
 * @property AccountTaxChart[] $accountTaxCharts
 * @property AccountStateOpen[] $accountStateOpens
 * @property AccountStatementFromInvoiceLines[] $accountStatementFromInvoiceLines
 * @property AccountPartnerReconcileProcess[] $accountPartnerReconcileProcesses
 * @property AccountSubscription[] $accountSubscriptions
 * @property AccountSubscriptionGenerate[] $accountSubscriptionGenerates
 * @property AccountUseModel[] $accountUseModels
 * @property AccountVoucherLine[] $accountVoucherLines
 * @property AccountUnreconcile[] $accountUnreconciles
 * @property AccountUnreconcileReconcile[] $accountUnreconcileReconciles
 * @property AccountVatDeclaration[] $accountVatDeclarations
 * @property AccountingReport[] $accountingReports
 * @property AccountVoucher[] $accountVouchers
 * @property AccountingLegal[] $accountingLegals
 * @property ActionTraceability[] $actionTraceabilities
 * @property AccountTaxTemplate[] $accountTaxTemplates
 * @property AfterActualKamis[] $afterActualKamis
 * @property AfterActualRabu[] $afterActualRabus
 * @property AfterActualSenin[] $afterActualSenins
 * @property AfterActualSabtu[] $afterActualSabtus
 * @property AfterActualSelasa[] $afterActualSelasas
 * @property AfterPlanAhad[] $afterPlanAhads
 * @property AfterPlanJumat[] $afterPlanJumats
 * @property AfterPlanKamis[] $afterPlanKamis
 * @property AfterPlanRabu[] $afterPlanRabus
 * @property AfterActualJumat[] $afterActualJumats
 * @property AfterActualAhad[] $afterActualAhads
 * @property AfterPlanSenin[] $afterPlanSenins
 * @property AssetDepreciationConfirmationWizard[] $assetDepreciationConfirmationWizards
 * @property AudittrailRule[] $audittrailRules
 * @property AudittrailLog[] $audittrailLogs
 * @property BaseActionRule[] $baseActionRules
 * @property AssetModify[] $assetModifies
 * @property AudittrailViewLog[] $audittrailViewLogs
 * @property BaseActionRuleLeadTest[] $baseActionRuleLeadTests
 * @property AfterPlanSelasa[] $afterPlanSelasas
 * @property AfterPlanSabtu[] $afterPlanSabtus
 * @property BaseImportImport[] $baseImportImports
 * @property BaseImportTestsModelsChar[] $baseImportTestsModelsChars
 * @property BaseImportTestsModelsCharRequired[] $baseImportTestsModelsCharRequireds
 * @property BaseImportTestsModelsCharNoreadonly[] $baseImportTestsModelsCharNoreadonlies
 * @property BaseImportTestsModelsCharReadonly[] $baseImportTestsModelsCharReadonlies
 * @property BaseImportTestsModelsCharStates[] $baseImportTestsModelsCharStates
 * @property BaseImportTestsModelsCharStillreadonly[] $baseImportTestsModelsCharStillreadonlies
 * @property BaseImportTestsModelsM2oRelated[] $baseImportTestsModelsM2oRelateds
 * @property BaseImportTestsModelsO2mChild[] $baseImportTestsModelsO2mChildren
 * @property BaseImportTestsModelsM2oRequiredRelated[] $baseImportTestsModelsM2oRequiredRelateds
 * @property BaseImportTestsModelsO2m[] $baseImportTestsModelsO2ms
 * @property BaseConfigSettings[] $baseConfigSettings
 * @property BaseLanguageImport[] $baseLanguageImports
 * @property BaseLanguageInstall[] $baseLanguageInstalls
 * @property BaseModuleConfiguration[] $baseModuleConfigurations
 * @property BaseModuleImport[] $baseModuleImports
 * @property BaseModuleUpdate[] $baseModuleUpdates
 * @property BaseModuleUpgrade[] $baseModuleUpgrades
 * @property BaseUpdateTranslations[] $baseUpdateTranslations
 * @property BaseSetupTerminology[] $baseSetupTerminologies
 * @property BeforeActualJumat[] $beforeActualJumats
 * @property BaseImportTestsModelsPreview[] $baseImportTestsModelsPreviews
 * @property BaseLanguageExport[] $baseLanguageExports
 * @property BeforeActualAhad[] $beforeActualAhads
 * @property BeforePlanAhad[] $beforePlanAhads
 * @property BeforeActualSabtu[] $beforeActualSabtus
 * @property BeforeActualSelasa[] $beforeActualSelasas
 * @property BeforeActualSenin[] $beforeActualSenins
 * @property BeforePlanJumat[] $beforePlanJumats
 * @property BeforePlanKamis[] $beforePlanKamis
 * @property BeforePlanRabu[] $beforePlanRabus
 * @property BeforePlanSabtu[] $beforePlanSabtus
 * @property BeforePlanSelasa[] $beforePlanSelasas
 * @property BeforeActualRabu[] $beforeActualRabus
 * @property BeforeActualKamis[] $beforeActualKamis
 * @property CalendarEvent[] $calendarEvents
 * @property BoardCreate[] $boardCreates
 * @property CalendarAttendee[] $calendarAttendees
 * @property BiayaWorkshop[] $biayaWorkshops
 * @property BeforePlanSenin[] $beforePlanSenins
 * @property CalendarTodo[] $calendarTodos
 * @property CalendarAlarm[] $calendarAlarms
 * @property CashBoxIn[] $cashBoxIns
 * @property CashBoxOut[] $cashBoxOuts
 * @property CatatanLine[] $catatanLines
 * @property ChangeProductionQty[] $changeProductionQties
 * @property DecimalPrecision[] $decimalPrecisions
 * @property DeliveryGridLine[] $deliveryGridLines
 * @property DeliveryGrid[] $deliveryGrs
 * @property DeliveryNoteLine[] $deliveryNoteLines
 * @property DeliveryCarrier[] $deliveryCarriers
 * @property DetailOrderLine[] $detailOrderLines
 * @property ChangePasswordWizard[] $changePasswordWizards
 * @property CrmMeeting[] $crmMeetings
 * @property DetailTunjanganDinas[] $detailTunjanganDinas
 * @property EmailTemplate[] $emailTemplates
 * @property EmailTemplatePreview[] $emailTemplatePreviews
 * @property GroupSales[] $groupSales
 * @property FetchmailConfigSettings[] $fetchmailConfigSettings
 * @property ExspensePisikotes[] $exspensePisikotes
 * @property HrActionReason[] $hrActionReasons
 * @property HistoryPayment[] $historyPayments
 * @property FetchmailServer[] $fetchmailServers
 * @property EksportImport[] $eksportImports
 * @property HrAttendanceError[] $hrAttendanceErrors
 * @property HrAttendanceMonth[] $hrAttendanceMonths
 * @property HrAttendanceWeek[] $hrAttendanceWeeks
 * @property HrConfigSettings[] $hrConfigSettings
 * @property HrExpenseLine[] $hrExpenseLines
 * @property HrEmployeeCategory[] $hrEmployeeCategories
 * @property HrExpenseExpense[] $hrExpenseExpenses
 * @property IrActions[] $irActions
 * @property HrdSiteemployee[] $hrdSiteemployees
 * @property HrJob[] $hrJobs
 * @property IrActWindowView[] $irActWindowViews
 * @property IrDefault[] $irDefaults
 * @property IrConfigParameter[] $irConfigParameters
 * @property IrActionsConfigurationWizard[] $irActionsConfigurationWizards
 * @property IrExports[] $irExports
 * @property IrActionsTodo[] $irActionsTodos
 * @property IrFieldsConverter[] $irFieldsConverters
 * @property IrAttachment[] $irAttachments
 * @property IrCron[] $irCrons
 * @property IrHeaderImg[] $irHeaderImgs
 * @property IrModelAccess[] $irModelAccesses
 * @property IrHeaderWebkit[] $irHeaderWebkits
 * @property IrMailServer[] $irMailServers
 * @property IrProperty[] $irProperties
 * @property IrModuleModuleDependency[] $irModuleModuleDependencies
 * @property IrServerObjectLines[] $irServerObjectLines
 * @property IrSequence[] $irSequences
 * @property IrModuleModule[] $irModuleModules
 * @property IrSequenceType[] $irSequenceTypes
 * @property IrModelFields[] $irModelFields
 * @property IrModuleCategory[] $irModuleCategories
 * @property IrUiViewSc[] $irUiViewScs
 * @property IrUiView[] $irUiViews
 * @property IrValues[] $irValues
 * @property LogActivity[] $logActivities
 * @property Jabatan[] $jabatans
 * @property LogStatusCustomer[] $logStatusCustomers
 * @property ManagementSummary[] $managementSummaries
 * @property ManyVoucher[] $manyVouchers
 * @property MrpProductProduce[] $mrpProductProduces
 * @property MrpProductPrice[] $mrpProductPrices
 * @property MrpConfigSettings[] $mrpConfigSettings
 * @property ProductPricelistItem[] $productPricelistItems
 * @property AccountTaxCodeTemplate[] $accountTaxCodeTemplates
 * @property AccountFiscalPositionAccount[] $accountFiscalPositionAccounts
 * @property AudittrailLogLine[] $audittrailLogLines
 * @property AccountInvoiceTax[] $accountInvoiceTaxes
 * @property AccountFinancialReport[] $accountFinancialReports
 * @property AccountAssetAsset[] $accountAssetAssets
 * @property AccountAccountType[] $accountAccountTypes
 * @property AccountModelLine[] $accountModelLines
 * @property AccountTaxCode[] $accountTaxCodes
 * @property AccountJournalPeriod[] $accountJournalPeriods
 * @property AccountAccountTemplate[] $accountAccountTemplates
 * @property AccountPaymentTermLine[] $accountPaymentTermLines
 * @property BaseImportTestsModelsM2oRequired[] $baseImportTestsModelsM2oRequireds
 * @property AudittailRulesUsers[] $audittailRulesUsers
 * @property BaseImportTestsModelsM2o[] $baseImportTestsModelsM2os
 * @property ChangePasswordUser[] $changePasswordUsers
 * @property IrUiViewCustom[] $irUiViewCustoms
 * @property HrHolidaysStatus[] $hrHolidaysStatuses
 * @property JenisTunjanganExpense[] $jenisTunjanganExpenses
 * @property GroupSalesLine[] $groupSalesLines
 * @property HrAttendance[] $hrAttendances
 * @property IrExportsLine[] $irExportsLines
 * @property HrHolidays[] $hrHolidays
 * @property IrFilters[] $irFilters
 * @property HrEmployee[] $hrEmployees
 * @property DetailPb[] $detailPbs
 * @property MailComposeMessage[] $mailComposeMessages
 * @property MailMessageSubtype[] $mailMessageSubtypes
 * @property MailGroup[] $mailGroups
 * @property MailVote[] $mailVotes
 * @property MailMail[] $mailMails
 * @property MailMessage[] $mailMessages
 * @property MailWizardInvite[] $mailWizardInvites
 * @property MakeProcurement[] $makeProcurements
 * @property MedicalRecord[] $medicalRecords
 * @property CrmMeetingType[] $crmMeetingTypes
 * @property MergePickings[] $mergePickings
 * @property MrpProductionProductLine[] $mrpProductionProductLines
 * @property MrpProductionWorkcenterLine[] $mrpProductionWorkcenterLines
 * @property MrpPropertyGroup[] $mrpPropertyGroups
 * @property AccountAnalyticAccount[] $accountAnalyticAccounts
 * @property MrpRoutingWorkcenter[] $mrpRoutingWorkcenters
 * @property MrpRouting[] $mrpRoutings
 * @property AccountAnalyticJournal[] $accountAnalyticJournals
 * @property MrpWorkcenterLoad[] $mrpWorkcenterLoads
 * @property MrpWorkcenter[] $mrpWorkcenters
 * @property MultiCompanyDefault[] $multiCompanyDefaults
 * @property MutasiAccount[] $mutasiAccounts
 * @property AccountAccount[] $accountAccounts
 * @property MutasiStock[] $mutasiStocks
 * @property OrderPreparationLine[] $orderPreparationLines
 * @property OrderPreparation[] $orderPreparations
 * @property OsvMemoryAutovacuum[] $osvMemoryAutovacuums
 * @property StockPicking[] $stockPickings
 * @property PembelianBarang[] $pembelianBarangs
 * @property PurchaseRequisitionSubcont[] $purchaseRequisitionSubconts
 * @property PerintahKerjaInternal[] $perintahKerjaInternals
 * @property PerintahKerjaLineInternal[] $perintahKerjaLineInternals
 * @property PerintahKerja[] $perintahKerjas
 * @property PerintahKerjaLine[] $perintahKerjaLines
 * @property PermissionEmployee[] $permissionEmployees
 * @property Port[] $ports
 * @property HrDepartment[] $hrDepartments
 * @property PermissionWizard[] $permissionWizards
 * @property PesertaPisikotes[] $pesertaPisikotes
 * @property PortalPaymentAcquirer[] $portalPaymentAcquirers
 * @property PortalWizardUser[] $portalWizardUsers
 * @property ProductSupplierinfo[] $productSupplierinfos
 * @property PortalWizard[] $portalWizards
 * @property Pr[] $prs
 * @property PricelistPartnerinfo[] $pricelistPartnerinfos
 * @property ProcessCondition[] $processConditions
 * @property IrModel[] $irModels
 * @property ProcessProcess[] $processProcesses
 * @property ProcessTransitionAction[] $processTransitionActions
 * @property ProcessNode[] $processNodes
 * @property ProcessTransition[] $processTransitions
 * @property MrpBom[] $mrpBoms
 * @property ProcurementOrderComputeAll[] $procurementOrderComputeAlls
 * @property ProcurementOrderCompute[] $procurementOrderComputes
 * @property ProductCategory[] $productCategories
 * @property ProcurementOrderpointCompute[] $procurementOrderpointComputes
 * @property PackingListLine[] $packingListLines
 * @property MrpProperty[] $mrpProperties
 * @property ProductListLine[] $productListLines
 * @property ProductPricelistVersion[] $productPricelistVersions
 * @property ProductPriceList[] $productPriceLists
 * @property ProductPricelistType[] $productPricelistTypes
 * @property ProductPriceType[] $productPriceTypes
 * @property ProductTemplate[] $productTemplates
 * @property ProductUl[] $productUls
 * @property ProductUomCateg[] $productUomCategs
 * @property ProjectAccountAnalyticLine[] $projectAccountAnalyticLines
 * @property PublisherWarrantyContract[] $publisherWarrantyContracts
 * @property PurchaseConfigSettings[] $purchaseConfigSettings
 * @property PurchaseOrderGroup[] $purchaseOrderGroups
 * @property PurchaseOrderLineInvoice[] $purchaseOrderLineInvoices
 * @property PurchaseOrderSubcontSentLine[] $purchaseOrderSubcontSentLines
 * @property PurchasePartialInvoice[] $purchasePartialInvoices
 * @property PurchaseRequisitionSubcontLineToSend[] $purchaseRequisitionSubcontLineToSends
 * @property PurchaseRequisitionSubcontSendLine[] $purchaseRequisitionSubcontSendLines
 * @property RawMaterialLine[] $rawMaterialLines
 * @property RemainderSalesman[] $remainderSalesmen
 * @property ReportWebkitActions[] $reportWebkitActions
 * @property ResAlarm[] $resAlarms
 * @property ResCompanyUsersRel[] $resCompanyUsersRels
 * @property ResConfigInstaller[] $resConfigInstallers
 * @property ResConfigSettings[] $resConfigSettings
 * @property ResConfig[] $resConfigs
 * @property ResCurrencyRateType[] $resCurrencyRateTypes
 * @property ResCurrencyRate[] $resCurrencyRates
 * @property ResGroupsUsersRel[] $resGroupsUsersRels
 * @property ResLang[] $resLangs
 * @property ResBank[] $resBanks
 * @property ResPartnerBankTypeField[] $resPartnerBankTypeFields
 * @property ResPartnerBankType[] $resPartnerBankTypes
 * @property ResPartnerBank[] $resPartnerBanks
 * @property ResCountry[] $resCountries
 * @property ResPartnerCategory[] $resPartnerCategories
 * @property ResCountryState[] $resCountryStates
 * @property ResPartnerTitle[] $resPartnerTitles
 * @property ResRequestHistory[] $resRequestHistories
 * @property ResRequestLink[] $resRequestLinks
 * @property ResRequest[] $resRequests
 * @property MailAlias[] $mailAliases
 * @property ResetStatus[] $resetStatuses
 * @property ResourceCalendarAttendance[] $resourceCalendarAttendances
 * @property ResourceCalendarLeaves[] $resourceCalendarLeaves
 * @property ResourceCalendar[] $resourceCalendars
 * @property ResourceResource[] $resourceResources
 * @property RiwayatPenyakit[] $riwayatPenyakits
 * @property IrRule[] $irRules
 * @property SaleAdvancePaymentInv[] $saleAdvancePaymentInvs
 * @property SaleConfigSettings[] $saleConfigSettings
 * @property SaleMakeInvoice[] $saleMakeInvoices
 * @property AccountInvoiceLine[] $accountInvoiceLines
 * @property SaleOrderLineMakeInvoice[] $saleOrderLineMakeInvoices
 * @property SaleOrderSummary[] $saleOrderSummaries
 * @property AccountTax[] $accountTaxes
 * @property AccountPaymentTerm[] $accountPaymentTerms
 * @property SaleShop[] $saleShops
 * @property ScopeWorkCustomer[] $scopeWorkCustomers
 * @property ScopeWorkSupra[] $scopeWorkSupras
 * @property ShareWizardResUserRel[] $shareWizardResUserRels
 * @property ShareWizardResultLine[] $shareWizardResultLines
 * @property ShareWizard[] $shareWizards
 * @property Site[] $sites
 * @property StatusSubline[] $statusSublines
 * @property StockChangeProductQty[] $stockChangeProductQties
 * @property StockChangeStandardPrice[] $stockChangeStandardPrices
 * @property StockConfigSettings[] $stockConfigSettings
 * @property StockFillInventory[] $stockFillInventories
 * @property StockIncoterms[] $stockIncoterms
 * @property StockInventoryLineSplitLines[] $stockInventoryLineSplitLines
 * @property StockInventoryLineSplit[] $stockInventoryLineSplits
 * @property StockInventoryLine[] $stockInventoryLines
 * @property StockInventoryMerge[] $stockInventoryMerges
 * @property StockInventory[] $stockInventories
 * @property StockInvoiceOnshipping[] $stockInvoiceOnshippings
 * @property StockLocationProduct[] $stockLocationProducts
 * @property StockMoveConsume[] $stockMoveConsumes
 * @property ProductPackaging[] $productPackagings
 * @property PurchaseOrderLine[] $purchaseOrderLines
 * @property SaleOrderLine[] $saleOrderLines
 * @property StockMoveScrap[] $stockMoveScraps
 * @property StockMoveSplitLines[] $stockMoveSplitLines
 * @property StockMoveSplit[] $stockMoveSplits
 * @property StockPartialMoveLine[] $stockPartialMoveLines
 * @property StockPartialMove[] $stockPartialMoves
 * @property StockPartialPickingLine[] $stockPartialPickingLines
 * @property StockPartialPicking[] $stockPartialPickings
 * @property AccountInvoice[] $accountInvoices
 * @property DeliveryNote[] $deliveryNotes
 * @property StockJournal[] $stockJournals
 * @property StockProductionLotRevision[] $stockProductionLotRevisions
 * @property StockProductionLot[] $stockProductionLots
 * @property StockMove[] $stockMoves
 * @property StockReturnPickingMemory[] $stockReturnPickingMemories
 * @property StockReturnPicking[] $stockReturnPickings
 * @property StockSplitInto[] $stockSplitIntos
 * @property StockTracking[] $stockTrackings
 * @property StockLocation[] $stockLocations
 * @property ProcurementOrder[] $procurementOrders
 * @property StockWarehouseOrderpoint[] $stockWarehouseOrderpoints
 * @property StockWarehouse[] $stockWarehouses
 * @property HrHolidaysSummaryDept[] $hrHolidaysSummaryDepts
 * @property HrHolidaysSummaryEmployee[] $hrHolidaysSummaryEmployees
 * @property SuratTugas[] $suratTugas
 * @property TempRange[] $tempRanges
 * @property TermCondition[] $termConditions
 * @property TunjanganExpense[] $tunjanganExpenses
 * @property TunjanganMealHotel[] $tunjanganMealHotels
 * @property HrExpenseDinas[] $hrExpenseDinas
 * @property TunjanganTransport[] $tunjanganTransports
 * @property TypePb[] $typePbs
 * @property AccountJournal[] $accountJournals
 * @property ValidateAccountMoveLines[] $validateAccountMoveLines
 * @property AccountPeriod[] $accountPeriods
 * @property ValidateAccountMove[] $validateAccountMoves
 * @property WeekStatusLine[] $weekStatusLines
 * @property WeekStatus[] $weekStatuses
 * @property SalesActivity[] $salesActivities
 * @property WizardAfterActualAhad[] $wizardAfterActualAhads
 * @property WizardAfterActualJumat[] $wizardAfterActualJumats
 * @property WizardAfterActualKamis[] $wizardAfterActualKamis
 * @property WizardAfterActualRabu[] $wizardAfterActualRabus
 * @property WizardAfterActualSabtu[] $wizardAfterActualSabtus
 * @property WizardAfterActualSelasa[] $wizardAfterActualSelasas
 * @property WizardAfterActualSenin[] $wizardAfterActualSenins
 * @property WizardAfterPlanAhad[] $wizardAfterPlanAhads
 * @property WizardAfterPlanJumat[] $wizardAfterPlanJumats
 * @property WizardAfterPlanKamis[] $wizardAfterPlanKamis
 * @property WizardAfterPlanRabu[] $wizardAfterPlanRabus
 * @property WizardAfterPlanSabtu[] $wizardAfterPlanSabtus
 * @property WizardAfterPlanSelasa[] $wizardAfterPlanSelasas
 * @property WizardAfterPlanSenin[] $wizardAfterPlanSenins
 * @property WizardBeforeActualAhad[] $wizardBeforeActualAhads
 * @property WizardBeforeActualJumat[] $wizardBeforeActualJumats
 * @property WizardBeforeActualKamis[] $wizardBeforeActualKamis
 * @property WizardBeforeActualRabu[] $wizardBeforeActualRabus
 * @property WizardBeforeActualSabtu[] $wizardBeforeActualSabtus
 * @property WizardBeforeActualSelasa[] $wizardBeforeActualSelasas
 * @property WizardBeforeActualSenin[] $wizardBeforeActualSenins
 * @property WizardBeforePlanAhad[] $wizardBeforePlanAhads
 * @property WizardBeforePlanJumat[] $wizardBeforePlanJumats
 * @property WizardBeforePlanKamis[] $wizardBeforePlanKamis
 * @property WizardBeforePlanRabu[] $wizardBeforePlanRabus
 * @property WizardBeforePlanSabtu[] $wizardBeforePlanSabtus
 * @property WizardBeforePlanSelasa[] $wizardBeforePlanSelasas
 * @property SaleOrder[] $saleOrders
 * @property WizardActivity[] $wizardActivities
 * @property WizardBeforePlanSenin[] $wizardBeforePlanSenins
 * @property SetPo[] $setPos
 * @property WizardDetailPb[] $wizardDetailPbs
 * @property IrUiMenu[] $irUiMenus
 * @property WizardIrModelMenuCreate[] $wizardIrModelMenuCreates
 * @property AccountChartTemplate[] $accountChartTemplates
 * @property ResCompany[] $resCompanies
 * @property ResCurrency[] $resCurrencies
 * @property WizardMultiChartsAccounts[] $wizardMultiChartsAccounts
 * @property ProductPricelist[] $productPricelists
 * @property RentRequisition[] $rentRequisitions
 * @property PurchaseRequisitionSubcontLine[] $purchaseRequisitionSubcontLines
 * @property PurchaseOrderLineFromRequisitionLines[] $purchaseOrderLineFromRequisitionLines
 * @property WizardPoRent[] $wizardPoRents
 * @property RentRequisitionDetail[] $rentRequisitionDetails
 * @property ProductProduct[] $productProducts
 * @property ProductUom[] $productUoms
 * @property ResPartner[] $resPartners
 * @property WizardRentRequisitionDetail[] $wizardRentRequisitionDetails
 * @property WizardUserRel[] $wizardUserRels
 * @property WkfLogs[] $wkfLogs
 * @property ResGroups[] $resGroups
 * @property WkfTransition[] $wkfTransitions
 * @property WkfActivity[] $wkfActivities
 * @property ResUsers $writeU
 * @property ResUsers[] $resUsers
 * @property ResPartner $partner
 * @property GroupSales $kelompok
 * @property ResUsers $createU
 * @property ResCompany $company
 * @property MailAlias $alias
 * @property Wkf[] $wkfs
 * @property PurchaseOrder[] $purchaseOrders
 * @property MrpProduction[] $mrpProductions
 */
class ResUsers extends \yii\db\ActiveRecord
{
	public $name;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'res_users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['active', 'share'], 'boolean'],
            [['login', 'company_id', 'partner_id', 'alias_id'], 'required'],
            [['company_id', 'partner_id', 'create_uid', 'write_uid', 'menu_id', 'action_id', 'alias_id', 'kelompok_id'], 'integer'],
            [['create_date', 'write_date', 'login_date'], 'safe'],
            [['signature'], 'string'],
            [['login', 'password'], 'string', 'max' => 64],
            [['initial'], 'string', 'max' => 254],
            [['login'], 'unique'],
            [['login'], 'unique']
        ];
    }
    public function afterFind(){
    	if($this->partner){
    		$this->name = $this->partner->name;
    	}
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'active' => 'Active',
            'login' => 'Login',
            'password' => 'Password',
            'company_id' => 'Company ID',
            'partner_id' => 'Partner ID',
            'create_uid' => 'Create Uid',
            'create_date' => 'Create Date',
            'write_date' => 'Write Date',
            'write_uid' => 'Write Uid',
            'menu_id' => 'Menu Action',
            'login_date' => 'Latest connection',
            'signature' => 'Signature',
            'action_id' => 'Home Action',
            'alias_id' => 'Alias',
            'share' => 'Share User',
            'initial' => 'Initial',
            'kelompok_id' => 'Groups Sales',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAgedTrialBalances()
    {
        return $this->hasMany(AccountAgedTrialBalance::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAnalyticCostLedgerJournalReports()
    {
        return $this->hasMany(AccountAnalyticCostLedgerJournalReport::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAnalyticBalances()
    {
        return $this->hasMany(AccountAnalyticBalance::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAnalyticCharts()
    {
        return $this->hasMany(AccountAnalyticChart::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAnalyticCostLedgers()
    {
        return $this->hasMany(AccountAnalyticCostLedger::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAnalyticInvertedBalances()
    {
        return $this->hasMany(AccountAnalyticInvertedBalance::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAddtmplWizards()
    {
        return $this->hasMany(AccountAddtmplWizard::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAnalyticLines()
    {
        return $this->hasMany(AccountAnalyticLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAnalyticJournalReports()
    {
        return $this->hasMany(AccountAnalyticJournalReport::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAutomaticReconciles()
    {
        return $this->hasMany(AccountAutomaticReconcile::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAssetDepreciationLines()
    {
        return $this->hasMany(AccountAssetDepreciationLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAssetCategories()
    {
        return $this->hasMany(AccountAssetCategory::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAssetHistories()
    {
        return $this->hasMany(AccountAssetHistory::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountBalanceReports()
    {
        return $this->hasMany(AccountBalanceReport::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountBankAccountsWizards()
    {
        return $this->hasMany(AccountBankAccountsWizard::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountBankStatements()
    {
        return $this->hasMany(AccountBankStatement::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountBankStatementLines()
    {
        return $this->hasMany(AccountBankStatementLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountChangeCurrencies()
    {
        return $this->hasMany(AccountChangeCurrency::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountCentralJournals()
    {
        return $this->hasMany(AccountCentralJournal::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountCharts()
    {
        return $this->hasMany(AccountChart::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountCommonAccountReports()
    {
        return $this->hasMany(AccountCommonAccountReport::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountCommonJournalReports()
    {
        return $this->hasMany(AccountCommonJournalReport::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountCommonPartnerReports()
    {
        return $this->hasMany(AccountCommonPartnerReport::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountCommonReports()
    {
        return $this->hasMany(AccountCommonReport::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountMoves()
    {
        return $this->hasMany(AccountMove::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountConfigSettings()
    {
        return $this->hasMany(AccountConfigSettings::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountCashboxLines()
    {
        return $this->hasMany(AccountCashboxLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountFiscalPositionAccountTemplates()
    {
        return $this->hasMany(AccountFiscalPositionAccountTemplate::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountFiscalyearCloseStates()
    {
        return $this->hasMany(AccountFiscalyearCloseState::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountFiscalPositionTaxTemplates()
    {
        return $this->hasMany(AccountFiscalPositionTaxTemplate::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountFiscalPositionTaxes()
    {
        return $this->hasMany(AccountFiscalPositionTax::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountFiscalPositionTaxGlobals()
    {
        return $this->hasMany(AccountFiscalPositionTaxGlobal::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountFiscalPositionTemplates()
    {
        return $this->hasMany(AccountFiscalPositionTemplate::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountFiscalyearCloses()
    {
        return $this->hasMany(AccountFiscalyearClose::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountFiscalyears()
    {
        return $this->hasMany(AccountFiscalyear::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountGeneralJournals()
    {
        return $this->hasMany(AccountGeneralJournal::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountMoveLines()
    {
        return $this->hasMany(AccountMoveLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountFiscalPositions()
    {
        return $this->hasMany(AccountFiscalPosition::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountInvoiceCancels()
    {
        return $this->hasMany(AccountInvoiceCancel::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountInvoiceConfirms()
    {
        return $this->hasMany(AccountInvoiceConfirm::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountInvoiceRefunds()
    {
        return $this->hasMany(AccountInvoiceRefund::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountJournalCashboxLines()
    {
        return $this->hasMany(AccountJournalCashboxLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountInstallers()
    {
        return $this->hasMany(AccountInstaller::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountJournalSelects()
    {
        return $this->hasMany(AccountJournalSelect::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountModels()
    {
        return $this->hasMany(AccountModel::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountMoveBankReconciles()
    {
        return $this->hasMany(AccountMoveBankReconcile::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountMoveLineReconcileWriteoffs()
    {
        return $this->hasMany(AccountMoveLineReconcileWriteoff::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountMoveLineReconcileSelects()
    {
        return $this->hasMany(AccountMoveLineReconcileSelect::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountMoveLineReconciles()
    {
        return $this->hasMany(AccountMoveLineReconcile::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountMoveLineUnreconcileSelects()
    {
        return $this->hasMany(AccountMoveLineUnreconcileSelect::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountOpenClosedFiscalyears()
    {
        return $this->hasMany(AccountOpenClosedFiscalyear::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountMoveReconciles()
    {
        return $this->hasMany(AccountMoveReconcile::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountPartnerBalances()
    {
        return $this->hasMany(AccountPartnerBalance::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountPartnerLedgers()
    {
        return $this->hasMany(AccountPartnerLedger::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountPrintJournals()
    {
        return $this->hasMany(AccountPrintJournal::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountPeriodCloses()
    {
        return $this->hasMany(AccountPeriodClose::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountSequenceFiscalyears()
    {
        return $this->hasMany(AccountSequenceFiscalyear::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountReportGeneralLedgers()
    {
        return $this->hasMany(AccountReportGeneralLedger::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountSubscriptionLines()
    {
        return $this->hasMany(AccountSubscriptionLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountTaxCharts()
    {
        return $this->hasMany(AccountTaxChart::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountStateOpens()
    {
        return $this->hasMany(AccountStateOpen::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountStatementFromInvoiceLines()
    {
        return $this->hasMany(AccountStatementFromInvoiceLines::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountPartnerReconcileProcesses()
    {
        return $this->hasMany(AccountPartnerReconcileProcess::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountSubscriptions()
    {
        return $this->hasMany(AccountSubscription::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountSubscriptionGenerates()
    {
        return $this->hasMany(AccountSubscriptionGenerate::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountUseModels()
    {
        return $this->hasMany(AccountUseModel::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountVoucherLines()
    {
        return $this->hasMany(AccountVoucherLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountUnreconciles()
    {
        return $this->hasMany(AccountUnreconcile::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountUnreconcileReconciles()
    {
        return $this->hasMany(AccountUnreconcileReconcile::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountVatDeclarations()
    {
        return $this->hasMany(AccountVatDeclaration::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountingReports()
    {
        return $this->hasMany(AccountingReport::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountVouchers()
    {
        return $this->hasMany(AccountVoucher::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountingLegals()
    {
        return $this->hasMany(AccountingLegal::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActionTraceabilities()
    {
        return $this->hasMany(ActionTraceability::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountTaxTemplates()
    {
        return $this->hasMany(AccountTaxTemplate::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterActualKamis()
    {
        return $this->hasMany(AfterActualKamis::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterActualRabus()
    {
        return $this->hasMany(AfterActualRabu::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterActualSenins()
    {
        return $this->hasMany(AfterActualSenin::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterActualSabtus()
    {
        return $this->hasMany(AfterActualSabtu::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterActualSelasas()
    {
        return $this->hasMany(AfterActualSelasa::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterPlanAhads()
    {
        return $this->hasMany(AfterPlanAhad::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterPlanJumats()
    {
        return $this->hasMany(AfterPlanJumat::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterPlanKamis()
    {
        return $this->hasMany(AfterPlanKamis::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterPlanRabus()
    {
        return $this->hasMany(AfterPlanRabu::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterActualJumats()
    {
        return $this->hasMany(AfterActualJumat::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterActualAhads()
    {
        return $this->hasMany(AfterActualAhad::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterPlanSenins()
    {
        return $this->hasMany(AfterPlanSenin::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssetDepreciationConfirmationWizards()
    {
        return $this->hasMany(AssetDepreciationConfirmationWizard::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAudittrailRules()
    {
        return $this->hasMany(AudittrailRule::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAudittrailLogs()
    {
        return $this->hasMany(AudittrailLog::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseActionRules()
    {
        return $this->hasMany(BaseActionRule::className(), ['act_user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssetModifies()
    {
        return $this->hasMany(AssetModify::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAudittrailViewLogs()
    {
        return $this->hasMany(AudittrailViewLog::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseActionRuleLeadTests()
    {
        return $this->hasMany(BaseActionRuleLeadTest::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterPlanSelasas()
    {
        return $this->hasMany(AfterPlanSelasa::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterPlanSabtus()
    {
        return $this->hasMany(AfterPlanSabtu::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseImportImports()
    {
        return $this->hasMany(BaseImportImport::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseImportTestsModelsChars()
    {
        return $this->hasMany(BaseImportTestsModelsChar::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseImportTestsModelsCharRequireds()
    {
        return $this->hasMany(BaseImportTestsModelsCharRequired::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseImportTestsModelsCharNoreadonlies()
    {
        return $this->hasMany(BaseImportTestsModelsCharNoreadonly::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseImportTestsModelsCharReadonlies()
    {
        return $this->hasMany(BaseImportTestsModelsCharReadonly::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseImportTestsModelsCharStates()
    {
        return $this->hasMany(BaseImportTestsModelsCharStates::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseImportTestsModelsCharStillreadonlies()
    {
        return $this->hasMany(BaseImportTestsModelsCharStillreadonly::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseImportTestsModelsM2oRelateds()
    {
        return $this->hasMany(BaseImportTestsModelsM2oRelated::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseImportTestsModelsO2mChildren()
    {
        return $this->hasMany(BaseImportTestsModelsO2mChild::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseImportTestsModelsM2oRequiredRelateds()
    {
        return $this->hasMany(BaseImportTestsModelsM2oRequiredRelated::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseImportTestsModelsO2ms()
    {
        return $this->hasMany(BaseImportTestsModelsO2m::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseConfigSettings()
    {
        return $this->hasMany(BaseConfigSettings::className(), ['auth_signup_template_user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseLanguageImports()
    {
        return $this->hasMany(BaseLanguageImport::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseLanguageInstalls()
    {
        return $this->hasMany(BaseLanguageInstall::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseModuleConfigurations()
    {
        return $this->hasMany(BaseModuleConfiguration::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseModuleImports()
    {
        return $this->hasMany(BaseModuleImport::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseModuleUpdates()
    {
        return $this->hasMany(BaseModuleUpdate::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseModuleUpgrades()
    {
        return $this->hasMany(BaseModuleUpgrade::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseUpdateTranslations()
    {
        return $this->hasMany(BaseUpdateTranslations::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseSetupTerminologies()
    {
        return $this->hasMany(BaseSetupTerminology::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforeActualJumats()
    {
        return $this->hasMany(BeforeActualJumat::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseImportTestsModelsPreviews()
    {
        return $this->hasMany(BaseImportTestsModelsPreview::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseLanguageExports()
    {
        return $this->hasMany(BaseLanguageExport::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforeActualAhads()
    {
        return $this->hasMany(BeforeActualAhad::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforePlanAhads()
    {
        return $this->hasMany(BeforePlanAhad::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforeActualSabtus()
    {
        return $this->hasMany(BeforeActualSabtu::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforeActualSelasas()
    {
        return $this->hasMany(BeforeActualSelasa::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforeActualSenins()
    {
        return $this->hasMany(BeforeActualSenin::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforePlanJumats()
    {
        return $this->hasMany(BeforePlanJumat::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforePlanKamis()
    {
        return $this->hasMany(BeforePlanKamis::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforePlanRabus()
    {
        return $this->hasMany(BeforePlanRabu::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforePlanSabtus()
    {
        return $this->hasMany(BeforePlanSabtu::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforePlanSelasas()
    {
        return $this->hasMany(BeforePlanSelasa::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforeActualRabus()
    {
        return $this->hasMany(BeforeActualRabu::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforeActualKamis()
    {
        return $this->hasMany(BeforeActualKamis::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCalendarEvents()
    {
        return $this->hasMany(CalendarEvent::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBoardCreates()
    {
        return $this->hasMany(BoardCreate::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCalendarAttendees()
    {
        return $this->hasMany(CalendarAttendee::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBiayaWorkshops()
    {
        return $this->hasMany(BiayaWorkshop::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforePlanSenins()
    {
        return $this->hasMany(BeforePlanSenin::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCalendarTodos()
    {
        return $this->hasMany(CalendarTodo::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCalendarAlarms()
    {
        return $this->hasMany(CalendarAlarm::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCashBoxIns()
    {
        return $this->hasMany(CashBoxIn::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCashBoxOuts()
    {
        return $this->hasMany(CashBoxOut::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCatatanLines()
    {
        return $this->hasMany(CatatanLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChangeProductionQties()
    {
        return $this->hasMany(ChangeProductionQty::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDecimalPrecisions()
    {
        return $this->hasMany(DecimalPrecision::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeliveryGridLines()
    {
        return $this->hasMany(DeliveryGridLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeliveryGrs()
    {
        return $this->hasMany(DeliveryGrid::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeliveryNoteLines()
    {
        return $this->hasMany(DeliveryNoteLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeliveryCarriers()
    {
        return $this->hasMany(DeliveryCarrier::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetailOrderLines()
    {
        return $this->hasMany(DetailOrderLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChangePasswordWizards()
    {
        return $this->hasMany(ChangePasswordWizard::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCrmMeetings()
    {
        return $this->hasMany(CrmMeeting::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetailTunjanganDinas()
    {
        return $this->hasMany(DetailTunjanganDinas::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmailTemplates()
    {
        return $this->hasMany(EmailTemplate::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmailTemplatePreviews()
    {
        return $this->hasMany(EmailTemplatePreview::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupSales()
    {
        return $this->hasMany(GroupSales::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFetchmailConfigSettings()
    {
        return $this->hasMany(FetchmailConfigSettings::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExspensePisikotes()
    {
        return $this->hasMany(ExspensePisikotes::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrActionReasons()
    {
        return $this->hasMany(HrActionReason::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHistoryPayments()
    {
        return $this->hasMany(HistoryPayment::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFetchmailServers()
    {
        return $this->hasMany(FetchmailServer::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEksportImports()
    {
        return $this->hasMany(EksportImport::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrAttendanceErrors()
    {
        return $this->hasMany(HrAttendanceError::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrAttendanceMonths()
    {
        return $this->hasMany(HrAttendanceMonth::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrAttendanceWeeks()
    {
        return $this->hasMany(HrAttendanceWeek::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrConfigSettings()
    {
        return $this->hasMany(HrConfigSettings::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrExpenseLines()
    {
        return $this->hasMany(HrExpenseLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrEmployeeCategories()
    {
        return $this->hasMany(HrEmployeeCategory::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrExpenseExpenses()
    {
        return $this->hasMany(HrExpenseExpense::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrActions()
    {
        return $this->hasMany(IrActions::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrdSiteemployees()
    {
        return $this->hasMany(HrdSiteemployee::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrJobs()
    {
        return $this->hasMany(HrJob::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrActWindowViews()
    {
        return $this->hasMany(IrActWindowView::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrDefaults()
    {
        return $this->hasMany(IrDefault::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrConfigParameters()
    {
        return $this->hasMany(IrConfigParameter::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrActionsConfigurationWizards()
    {
        return $this->hasMany(IrActionsConfigurationWizard::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrExports()
    {
        return $this->hasMany(IrExports::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrActionsTodos()
    {
        return $this->hasMany(IrActionsTodo::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrFieldsConverters()
    {
        return $this->hasMany(IrFieldsConverter::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrAttachments()
    {
        return $this->hasMany(IrAttachment::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrCrons()
    {
        return $this->hasMany(IrCron::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrHeaderImgs()
    {
        return $this->hasMany(IrHeaderImg::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrModelAccesses()
    {
        return $this->hasMany(IrModelAccess::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrHeaderWebkits()
    {
        return $this->hasMany(IrHeaderWebkit::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrMailServers()
    {
        return $this->hasMany(IrMailServer::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrProperties()
    {
        return $this->hasMany(IrProperty::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrModuleModuleDependencies()
    {
        return $this->hasMany(IrModuleModuleDependency::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrServerObjectLines()
    {
        return $this->hasMany(IrServerObjectLines::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrSequences()
    {
        return $this->hasMany(IrSequence::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrModuleModules()
    {
        return $this->hasMany(IrModuleModule::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrSequenceTypes()
    {
        return $this->hasMany(IrSequenceType::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrModelFields()
    {
        return $this->hasMany(IrModelFields::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrModuleCategories()
    {
        return $this->hasMany(IrModuleCategory::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrUiViewScs()
    {
        return $this->hasMany(IrUiViewSc::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrUiViews()
    {
        return $this->hasMany(IrUiView::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrValues()
    {
        return $this->hasMany(IrValues::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogActivities()
    {
        return $this->hasMany(LogActivity::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJabatans()
    {
        return $this->hasMany(Jabatan::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogStatusCustomers()
    {
        return $this->hasMany(LogStatusCustomer::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManagementSummaries()
    {
        return $this->hasMany(ManagementSummary::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManyVouchers()
    {
        return $this->hasMany(ManyVoucher::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrpProductProduces()
    {
        return $this->hasMany(MrpProductProduce::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrpProductPrices()
    {
        return $this->hasMany(MrpProductPrice::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrpConfigSettings()
    {
        return $this->hasMany(MrpConfigSettings::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductPricelistItems()
    {
        return $this->hasMany(ProductPricelistItem::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountTaxCodeTemplates()
    {
        return $this->hasMany(AccountTaxCodeTemplate::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountFiscalPositionAccounts()
    {
        return $this->hasMany(AccountFiscalPositionAccount::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAudittrailLogLines()
    {
        return $this->hasMany(AudittrailLogLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountInvoiceTaxes()
    {
        return $this->hasMany(AccountInvoiceTax::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountFinancialReports()
    {
        return $this->hasMany(AccountFinancialReport::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAssetAssets()
    {
        return $this->hasMany(AccountAssetAsset::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAccountTypes()
    {
        return $this->hasMany(AccountAccountType::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountModelLines()
    {
        return $this->hasMany(AccountModelLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountTaxCodes()
    {
        return $this->hasMany(AccountTaxCode::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountJournalPeriods()
    {
        return $this->hasMany(AccountJournalPeriod::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAccountTemplates()
    {
        return $this->hasMany(AccountAccountTemplate::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountPaymentTermLines()
    {
        return $this->hasMany(AccountPaymentTermLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseImportTestsModelsM2oRequireds()
    {
        return $this->hasMany(BaseImportTestsModelsM2oRequired::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAudittailRulesUsers()
    {
        return $this->hasMany(AudittailRulesUsers::className(), ['rule_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseImportTestsModelsM2os()
    {
        return $this->hasMany(BaseImportTestsModelsM2o::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChangePasswordUsers()
    {
        return $this->hasMany(ChangePasswordUser::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrUiViewCustoms()
    {
        return $this->hasMany(IrUiViewCustom::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrHolidaysStatuses()
    {
        return $this->hasMany(HrHolidaysStatus::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJenisTunjanganExpenses()
    {
        return $this->hasMany(JenisTunjanganExpense::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupSalesLines()
    {
        return $this->hasMany(GroupSalesLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrAttendances()
    {
        return $this->hasMany(HrAttendance::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrExportsLines()
    {
        return $this->hasMany(IrExportsLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrHolidays()
    {
        return $this->hasMany(HrHolidays::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrFilters()
    {
        return $this->hasMany(IrFilters::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrEmployees()
    {
        return $this->hasMany(HrEmployee::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetailPbs()
    {
        return $this->hasMany(DetailPb::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMailComposeMessages()
    {
        return $this->hasMany(MailComposeMessage::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMailMessageSubtypes()
    {
        return $this->hasMany(MailMessageSubtype::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMailGroups()
    {
        return $this->hasMany(MailGroup::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMailVotes()
    {
        return $this->hasMany(MailVote::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMailMails()
    {
        return $this->hasMany(MailMail::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMailMessages()
    {
        return $this->hasMany(MailMessage::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMailWizardInvites()
    {
        return $this->hasMany(MailWizardInvite::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMakeProcurements()
    {
        return $this->hasMany(MakeProcurement::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMedicalRecords()
    {
        return $this->hasMany(MedicalRecord::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCrmMeetingTypes()
    {
        return $this->hasMany(CrmMeetingType::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMergePickings()
    {
        return $this->hasMany(MergePickings::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrpProductionProductLines()
    {
        return $this->hasMany(MrpProductionProductLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrpProductionWorkcenterLines()
    {
        return $this->hasMany(MrpProductionWorkcenterLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrpPropertyGroups()
    {
        return $this->hasMany(MrpPropertyGroup::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAnalyticAccounts()
    {
        return $this->hasMany(AccountAnalyticAccount::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrpRoutingWorkcenters()
    {
        return $this->hasMany(MrpRoutingWorkcenter::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrpRoutings()
    {
        return $this->hasMany(MrpRouting::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAnalyticJournals()
    {
        return $this->hasMany(AccountAnalyticJournal::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrpWorkcenterLoads()
    {
        return $this->hasMany(MrpWorkcenterLoad::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrpWorkcenters()
    {
        return $this->hasMany(MrpWorkcenter::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMultiCompanyDefaults()
    {
        return $this->hasMany(MultiCompanyDefault::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMutasiAccounts()
    {
        return $this->hasMany(MutasiAccount::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAccounts()
    {
        return $this->hasMany(AccountAccount::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMutasiStocks()
    {
        return $this->hasMany(MutasiStock::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderPreparationLines()
    {
        return $this->hasMany(OrderPreparationLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderPreparations()
    {
        return $this->hasMany(OrderPreparation::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOsvMemoryAutovacuums()
    {
        return $this->hasMany(OsvMemoryAutovacuum::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockPickings()
    {
        return $this->hasMany(StockPicking::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPembelianBarangs()
    {
        return $this->hasMany(PembelianBarang::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseRequisitionSubconts()
    {
        return $this->hasMany(PurchaseRequisitionSubcont::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerintahKerjaInternals()
    {
        return $this->hasMany(PerintahKerjaInternal::className(), ['approver' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerintahKerjaLineInternals()
    {
        return $this->hasMany(PerintahKerjaLineInternal::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerintahKerjas()
    {
        return $this->hasMany(PerintahKerja::className(), ['approver' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerintahKerjaLines()
    {
        return $this->hasMany(PerintahKerjaLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPermissionEmployees()
    {
        return $this->hasMany(PermissionEmployee::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPorts()
    {
        return $this->hasMany(Port::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrDepartments()
    {
        return $this->hasMany(HrDepartment::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPermissionWizards()
    {
        return $this->hasMany(PermissionWizard::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPesertaPisikotes()
    {
        return $this->hasMany(PesertaPisikotes::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPortalPaymentAcquirers()
    {
        return $this->hasMany(PortalPaymentAcquirer::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPortalWizardUsers()
    {
        return $this->hasMany(PortalWizardUser::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductSupplierinfos()
    {
        return $this->hasMany(ProductSupplierinfo::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPortalWizards()
    {
        return $this->hasMany(PortalWizard::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrs()
    {
        return $this->hasMany(Pr::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPricelistPartnerinfos()
    {
        return $this->hasMany(PricelistPartnerinfo::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcessConditions()
    {
        return $this->hasMany(ProcessCondition::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrModels()
    {
        return $this->hasMany(IrModel::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcessProcesses()
    {
        return $this->hasMany(ProcessProcess::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcessTransitionActions()
    {
        return $this->hasMany(ProcessTransitionAction::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcessNodes()
    {
        return $this->hasMany(ProcessNode::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcessTransitions()
    {
        return $this->hasMany(ProcessTransition::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrpBoms()
    {
        return $this->hasMany(MrpBom::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcurementOrderComputeAlls()
    {
        return $this->hasMany(ProcurementOrderComputeAll::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcurementOrderComputes()
    {
        return $this->hasMany(ProcurementOrderCompute::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductCategories()
    {
        return $this->hasMany(ProductCategory::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcurementOrderpointComputes()
    {
        return $this->hasMany(ProcurementOrderpointCompute::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPackingListLines()
    {
        return $this->hasMany(PackingListLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrpProperties()
    {
        return $this->hasMany(MrpProperty::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductListLines()
    {
        return $this->hasMany(ProductListLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductPricelistVersions()
    {
        return $this->hasMany(ProductPricelistVersion::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductPriceListss()
    {
        return $this->hasMany(ProductPriceList::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductPricelistTypes()
    {
        return $this->hasMany(ProductPricelistType::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductPriceTypes()
    {
        return $this->hasMany(ProductPriceType::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductTemplates()
    {
        return $this->hasMany(ProductTemplate::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductUls()
    {
        return $this->hasMany(ProductUl::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductUomCategs()
    {
        return $this->hasMany(ProductUomCateg::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectAccountAnalyticLines()
    {
        return $this->hasMany(ProjectAccountAnalyticLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublisherWarrantyContracts()
    {
        return $this->hasMany(PublisherWarrantyContract::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseConfigSettings()
    {
        return $this->hasMany(PurchaseConfigSettings::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrderGroups()
    {
        return $this->hasMany(PurchaseOrderGroup::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrderLineInvoices()
    {
        return $this->hasMany(PurchaseOrderLineInvoice::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrderSubcontSentLines()
    {
        return $this->hasMany(PurchaseOrderSubcontSentLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchasePartialInvoices()
    {
        return $this->hasMany(PurchasePartialInvoice::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseRequisitionSubcontLineToSends()
    {
        return $this->hasMany(PurchaseRequisitionSubcontLineToSend::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseRequisitionSubcontSendLines()
    {
        return $this->hasMany(PurchaseRequisitionSubcontSendLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRawMaterialLines()
    {
        return $this->hasMany(RawMaterialLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRemainderSalesmen()
    {
        return $this->hasMany(RemainderSalesman::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReportWebkitActions()
    {
        return $this->hasMany(ReportWebkitActions::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResAlarms()
    {
        return $this->hasMany(ResAlarm::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResCompanyUsersRels()
    {
        return $this->hasMany(ResCompanyUsersRel::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResConfigInstallers()
    {
        return $this->hasMany(ResConfigInstaller::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResConfigSettings()
    {
        return $this->hasMany(ResConfigSettings::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResConfigs()
    {
        return $this->hasMany(ResConfig::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResCurrencyRateTypes()
    {
        return $this->hasMany(ResCurrencyRateType::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResCurrencyRates()
    {
        return $this->hasMany(ResCurrencyRate::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResGroupsUsersRels()
    {
        return $this->hasMany(ResGroupsUsersRel::className(), ['uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResLangs()
    {
        return $this->hasMany(ResLang::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResBanks()
    {
        return $this->hasMany(ResBank::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResPartnerBankTypeFields()
    {
        return $this->hasMany(ResPartnerBankTypeField::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResPartnerBankTypes()
    {
        return $this->hasMany(ResPartnerBankType::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResPartnerBanks()
    {
        return $this->hasMany(ResPartnerBank::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResCountries()
    {
        return $this->hasMany(ResCountry::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResPartnerCategories()
    {
        return $this->hasMany(ResPartnerCategory::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResCountryStates()
    {
        return $this->hasMany(ResCountryState::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResPartnerTitles()
    {
        return $this->hasMany(ResPartnerTitle::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResRequestHistories()
    {
        return $this->hasMany(ResRequestHistory::className(), ['act_from' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResRequestLinks()
    {
        return $this->hasMany(ResRequestLink::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResRequests()
    {
        return $this->hasMany(ResRequest::className(), ['act_from' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMailAliases()
    {
        return $this->hasMany(MailAlias::className(), ['alias_user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResetStatuses()
    {
        return $this->hasMany(ResetStatus::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResourceCalendarAttendances()
    {
        return $this->hasMany(ResourceCalendarAttendance::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResourceCalendarLeaves()
    {
        return $this->hasMany(ResourceCalendarLeaves::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResourceCalendars()
    {
        return $this->hasMany(ResourceCalendar::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResourceResources()
    {
        return $this->hasMany(ResourceResource::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRiwayatPenyakits()
    {
        return $this->hasMany(RiwayatPenyakit::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrRules()
    {
        return $this->hasMany(IrRule::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleAdvancePaymentInvs()
    {
        return $this->hasMany(SaleAdvancePaymentInv::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleConfigSettings()
    {
        return $this->hasMany(SaleConfigSettings::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleMakeInvoices()
    {
        return $this->hasMany(SaleMakeInvoice::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountInvoiceLines()
    {
        return $this->hasMany(AccountInvoiceLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleOrderLineMakeInvoices()
    {
        return $this->hasMany(SaleOrderLineMakeInvoice::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleOrderSummaries()
    {
        return $this->hasMany(SaleOrderSummary::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountTaxes()
    {
        return $this->hasMany(AccountTax::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountPaymentTerms()
    {
        return $this->hasMany(AccountPaymentTerm::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleShops()
    {
        return $this->hasMany(SaleShop::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScopeWorkCustomers()
    {
        return $this->hasMany(ScopeWorkCustomer::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScopeWorkSupras()
    {
        return $this->hasMany(ScopeWorkSupra::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShareWizardResUserRels()
    {
        return $this->hasMany(ShareWizardResUserRel::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShareWizardResultLines()
    {
        return $this->hasMany(ShareWizardResultLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShareWizards()
    {
        return $this->hasMany(ShareWizard::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSites()
    {
        return $this->hasMany(Site::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatusSublines()
    {
        return $this->hasMany(StatusSubline::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockChangeProductQties()
    {
        return $this->hasMany(StockChangeProductQty::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockChangeStandardPrices()
    {
        return $this->hasMany(StockChangeStandardPrice::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockConfigSettings()
    {
        return $this->hasMany(StockConfigSettings::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockFillInventories()
    {
        return $this->hasMany(StockFillInventory::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockIncoterms()
    {
        return $this->hasMany(StockIncoterms::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockInventoryLineSplitLines()
    {
        return $this->hasMany(StockInventoryLineSplitLines::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockInventoryLineSplits()
    {
        return $this->hasMany(StockInventoryLineSplit::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockInventoryLines()
    {
        return $this->hasMany(StockInventoryLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockInventoryMerges()
    {
        return $this->hasMany(StockInventoryMerge::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockInventories()
    {
        return $this->hasMany(StockInventory::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockInvoiceOnshippings()
    {
        return $this->hasMany(StockInvoiceOnshipping::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockLocationProducts()
    {
        return $this->hasMany(StockLocationProduct::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockMoveConsumes()
    {
        return $this->hasMany(StockMoveConsume::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductPackagings()
    {
        return $this->hasMany(ProductPackaging::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrderLines()
    {
        return $this->hasMany(PurchaseOrderLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleOrderLines()
    {
        return $this->hasMany(SaleOrderLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockMoveScraps()
    {
        return $this->hasMany(StockMoveScrap::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockMoveSplitLines()
    {
        return $this->hasMany(StockMoveSplitLines::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockMoveSplits()
    {
        return $this->hasMany(StockMoveSplit::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockPartialMoveLines()
    {
        return $this->hasMany(StockPartialMoveLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockPartialMoves()
    {
        return $this->hasMany(StockPartialMove::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockPartialPickingLines()
    {
        return $this->hasMany(StockPartialPickingLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockPartialPickings()
    {
        return $this->hasMany(StockPartialPicking::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountInvoices()
    {
        return $this->hasMany(AccountInvoice::className(), ['approver' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeliveryNotes()
    {
        return $this->hasMany(DeliveryNote::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockJournals()
    {
        return $this->hasMany(StockJournal::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockProductionLotRevisions()
    {
        return $this->hasMany(StockProductionLotRevision::className(), ['author_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockProductionLots()
    {
        return $this->hasMany(StockProductionLot::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockMoves()
    {
        return $this->hasMany(StockMove::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockReturnPickingMemories()
    {
        return $this->hasMany(StockReturnPickingMemory::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockReturnPickings()
    {
        return $this->hasMany(StockReturnPicking::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockSplitIntos()
    {
        return $this->hasMany(StockSplitInto::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockTrackings()
    {
        return $this->hasMany(StockTracking::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockLocations()
    {
        return $this->hasMany(StockLocation::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcurementOrders()
    {
        return $this->hasMany(ProcurementOrder::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockWarehouseOrderpoints()
    {
        return $this->hasMany(StockWarehouseOrderpoint::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockWarehouses()
    {
        return $this->hasMany(StockWarehouse::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrHolidaysSummaryDepts()
    {
        return $this->hasMany(HrHolidaysSummaryDept::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrHolidaysSummaryEmployees()
    {
        return $this->hasMany(HrHolidaysSummaryEmployee::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuratTugas()
    {
        return $this->hasMany(SuratTugas::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTempRanges()
    {
        return $this->hasMany(TempRange::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTermConditions()
    {
        return $this->hasMany(TermCondition::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTunjanganExpenses()
    {
        return $this->hasMany(TunjanganExpense::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTunjanganMealHotels()
    {
        return $this->hasMany(TunjanganMealHotel::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrExpenseDinas()
    {
        return $this->hasMany(HrExpenseDinas::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTunjanganTransports()
    {
        return $this->hasMany(TunjanganTransport::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTypePbs()
    {
        return $this->hasMany(TypePb::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountJournals()
    {
        return $this->hasMany(AccountJournal::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getValidateAccountMoveLines()
    {
        return $this->hasMany(ValidateAccountMoveLines::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountPeriods()
    {
        return $this->hasMany(AccountPeriod::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getValidateAccountMoves()
    {
        return $this->hasMany(ValidateAccountMove::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWeekStatusLines()
    {
        return $this->hasMany(WeekStatusLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWeekStatuses()
    {
        return $this->hasMany(WeekStatus::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalesActivities()
    {
        return $this->hasMany(SalesActivity::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterActualAhads()
    {
        return $this->hasMany(WizardAfterActualAhad::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterActualJumats()
    {
        return $this->hasMany(WizardAfterActualJumat::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterActualKamis()
    {
        return $this->hasMany(WizardAfterActualKamis::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterActualRabus()
    {
        return $this->hasMany(WizardAfterActualRabu::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterActualSabtus()
    {
        return $this->hasMany(WizardAfterActualSabtu::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterActualSelasas()
    {
        return $this->hasMany(WizardAfterActualSelasa::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterActualSenins()
    {
        return $this->hasMany(WizardAfterActualSenin::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterPlanAhads()
    {
        return $this->hasMany(WizardAfterPlanAhad::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterPlanJumats()
    {
        return $this->hasMany(WizardAfterPlanJumat::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterPlanKamis()
    {
        return $this->hasMany(WizardAfterPlanKamis::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterPlanRabus()
    {
        return $this->hasMany(WizardAfterPlanRabu::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterPlanSabtus()
    {
        return $this->hasMany(WizardAfterPlanSabtu::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterPlanSelasas()
    {
        return $this->hasMany(WizardAfterPlanSelasa::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterPlanSenins()
    {
        return $this->hasMany(WizardAfterPlanSenin::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforeActualAhads()
    {
        return $this->hasMany(WizardBeforeActualAhad::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforeActualJumats()
    {
        return $this->hasMany(WizardBeforeActualJumat::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforeActualKamis()
    {
        return $this->hasMany(WizardBeforeActualKamis::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforeActualRabus()
    {
        return $this->hasMany(WizardBeforeActualRabu::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforeActualSabtus()
    {
        return $this->hasMany(WizardBeforeActualSabtu::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforeActualSelasas()
    {
        return $this->hasMany(WizardBeforeActualSelasa::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforeActualSenins()
    {
        return $this->hasMany(WizardBeforeActualSenin::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforePlanAhads()
    {
        return $this->hasMany(WizardBeforePlanAhad::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforePlanJumats()
    {
        return $this->hasMany(WizardBeforePlanJumat::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforePlanKamis()
    {
        return $this->hasMany(WizardBeforePlanKamis::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforePlanRabus()
    {
        return $this->hasMany(WizardBeforePlanRabu::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforePlanSabtus()
    {
        return $this->hasMany(WizardBeforePlanSabtu::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforePlanSelasas()
    {
        return $this->hasMany(WizardBeforePlanSelasa::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleOrders()
    {
        return $this->hasMany(SaleOrder::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardActivities()
    {
        return $this->hasMany(WizardActivity::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforePlanSenins()
    {
        return $this->hasMany(WizardBeforePlanSenin::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSetPos()
    {
        return $this->hasMany(SetPo::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardDetailPbs()
    {
        return $this->hasMany(WizardDetailPb::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrUiMenus()
    {
        return $this->hasMany(IrUiMenu::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardIrModelMenuCreates()
    {
        return $this->hasMany(WizardIrModelMenuCreate::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountChartTemplates()
    {
        return $this->hasMany(AccountChartTemplate::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResCompanies()
    {
        return $this->hasMany(ResCompany::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResCurrencies()
    {
        return $this->hasMany(ResCurrency::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardMultiChartsAccounts()
    {
        return $this->hasMany(WizardMultiChartsAccounts::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductPricelists()
    {
        return $this->hasMany(ProductPricelist::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentRequisitions()
    {
        return $this->hasMany(RentRequisition::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseRequisitionSubcontLines()
    {
        return $this->hasMany(PurchaseRequisitionSubcontLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrderLineFromRequisitionLines()
    {
        return $this->hasMany(PurchaseOrderLineFromRequisitionLines::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardPoRents()
    {
        return $this->hasMany(WizardPoRent::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentRequisitionDetails()
    {
        return $this->hasMany(RentRequisitionDetail::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductProducts()
    {
        return $this->hasMany(ProductProduct::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductUoms()
    {
        return $this->hasMany(ProductUom::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResPartners()
    {
        return $this->hasMany(ResPartner::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardRentRequisitionDetails()
    {
        return $this->hasMany(WizardRentRequisitionDetail::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardUserRels()
    {
        return $this->hasMany(WizardUserRel::className(), ['wizard_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWkfLogs()
    {
        return $this->hasMany(WkfLogs::className(), ['uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResGroups()
    {
        return $this->hasMany(ResGroups::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWkfTransitions()
    {
        return $this->hasMany(WkfTransition::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWkfActivities()
    {
        return $this->hasMany(WkfActivity::className(), ['create_uid' => 'id']);
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
    public function getResUsers()
    {
        return $this->hasMany(ResUsers::className(), ['create_uid' => 'id']);
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
    public function getKelompok()
    {
        return $this->hasOne(GroupSales::className(), ['id' => 'kelompok_id']);
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
    public function getAlias()
    {
        return $this->hasOne(MailAlias::className(), ['id' => 'alias_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWkfs()
    {
        return $this->hasMany(Wkf::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrders()
    {
        return $this->hasMany(PurchaseOrder::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrpProductions()
    {
        return $this->hasMany(MrpProduction::className(), ['create_uid' => 'id']);
    }
}
