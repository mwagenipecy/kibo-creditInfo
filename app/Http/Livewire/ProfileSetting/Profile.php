<?php

namespace App\Http\Livewire\ProfileSetting;

use App\Models\AccountsModel;
use App\Models\Employee;
use App\Models\general_ledger;
use App\Models\Loan_sub_products;
use App\Models\loans_schedules;
use App\Models\loans_summary;
use App\Models\LoansModel;
use Carbon\Carbon;
use DOMDocument;
use DOMXPath;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Livewire\Component;



use App\Models\ClientsModel;



use App\Mail\LoanProgress;

use Livewire\WithFileUploads;
use App\Models\Clients;
use mysql_xdevapi\Schema;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;


class Profile extends Component
{
    public $showDialog;

    public $currentStep = 1;
    public $userInfo;
    public $companyInfo;
    public $paymentInfo;

    public $application;

    public $photo;
    public $futureInterest=false;

    public $collateral_type;
    public $collateral_description;
    public $daily_sales;
    public $loan;
    public $collateral_value;
    public $loan_sub_product;
    public $tenure = 12;
    public $principle;
    public $member;


    public $guarantor;
    public $disbursement_account;
    public $collection_account_loan_interest;
    public $collection_account_loan_principle;
    public $collection_account_loan_charges;
    public $collection_account_loan_penalties;
    public $principle_min_value;
    public $principle_max_value;
    public $min_term;
    public $max_term;
    public $interest_value;
    public $principle_grace_period;
    public $interest_grace_period;
    public $amortization_method;
    public $days_in_a_month = 30;
    public $loan_id;
    public $loan_account_number;

    public $member_number;
    public $topUpBoolena;
    public $new_principle;


    public $interest;
    public $business_licence_number;
    public $business_tin_number;
    public $business_inventory;
    public $cash_at_hand;

    public $cost_of_goods_sold;
    public $operating_expenses;
    public $monthly_taxes;
    public $other_expenses;
    public $monthly_sales;
    public $gross_profit;
    public $table;
    public $tablefooter;
    public $recommended_tenure;
    public $recommended_installment;
    public $recommended = false;
    public $business_age;
    public $bank1=123456;
    public  $available_funds;

    public $interest_method;
    public $future_interests;
    public $futureInsteresAmount;
    public $valueAmmount;

    public $make_and_model;
    public $purchase_price;


    protected $listeners = ['showApplication' => 'handleShowApplication'];

    public function handleShowApplication($id)
    {
        $this->showDialog = true;
        $this->application = $id;

        //dd($this->application);
        $application = \Illuminate\Support\Facades\DB::table('applications')->where('loan_id',$this->application)->first();
        foreach (get_object_vars($application) as $field => $value){
            if($field=="loan_amount"){
                $this->principle =  $value;
            }
            if($field=="make_and_model"){
                $this->make_and_model =  $value;
            }
            if($field=="purchase_price"){
                $this->purchase_price =  $value;
            }
        }
    }


    public function sendSoapRequest()
    {
        // Your SOAP envelope XML
        $soapEnvelope = '
            <s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">
                <s:Header>
                    <wsse:Security s:mustUnderstand="1" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">
                        <wsse:UsernameToken wsu:Id="SecurityToken-ad2b9f33-eba3-4e0f-ae41-e90379b97f56" xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">
                            <wsse:Username>Username</wsse:Username>
                            <wsse:Password>Password</wsse:Password>
                        </wsse:UsernameToken>
                    </wsse:Security>
                </s:Header>
                <s:Body>
                    <Query xmlns="http://creditinfo.com/schemas/2012/09/MultiConnector">
                        <request xmlns:i="http://www.w3.org/2001/XMLSchema-instance">
                            <MessageId>${=java.util.UUID.randomUUID()}</MessageId>
                            <RequestXml>
                                <RequestXml xmlns="http://creditinfo.com/schemas/2012/09/MultiConnector/Messages/Request">
                                    <connector id="connectorID">
                                        <data id="${=java.util.UUID.randomUUID()}">
                                            <request xmlns="http://creditinfo.com/schemas/2012/09/MultiConnector/Connectors/Bee/Request"
                                                xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
                                                xsi:schemaLocation="http://creditinfo.com/schemas/2012/09/MultiConnector/Connectors/Bee/Request file:/C:/Users/d.felix/Desktop/Smart%20Search/Smart%20Search/TZA_NMB_BeeRequest.xsd">
                                                <DecisionWorkflow>NMB.TZA.Base</DecisionWorkflow>
                                                <RequestData>
                                                    <Individual>
                                                        <DateOfBirth>1996-01-10T21:00:00Z</DateOfBirth>
                                                        <FullName>JOSEPH EDMUND MBUYA</FullName>
                                                        <IdNumbers>
                                                            <IdNumberPairIndividual>
                                                                <IdNumber>19850723-14125-00004-24</IdNumber>
                                                                <IdNumberType>NationalID</IdNumberType>
                                                            </IdNumberPairIndividual>
                                                        </IdNumbers>
                                                        <PhoneNumbers>
                                                            <string></string>
                                                        </PhoneNumbers>
                                                        <InquiryReasons>ApplicationForCreditOrAmendmentOfCreditTerms</InquiryReasons>
                                                        <CreditInfoId></CreditInfoId>
                                                        <TypeOfReport>CreditinfoReportPlus</TypeOfReport>
                                                    </Individual>
                                                </RequestData>
                                            </request>
                                        </data>
                                    </connector>
                                </RequestXml>
                            </RequestXml>
                            <Timeout i:nil="true"/>
                        </request>
                    </Query>
                </s:Body>
            </s:Envelope>
        ';

        // Make SOAP request using Laravel HTTP client
        $response = Http::withHeaders([
            'Content-Type' => 'text/xml; charset=UTF-8',
            'SOAPAction' => '', // Add your SOAPAction header if required
        ])
            ->post('http://your-soap-endpoint.com', [
                'xml' => $soapEnvelope,
            ]);

        // Process the response
        $result = $response->body(); // Adjust this based on your SOAP response format

        // ... (further processing or returning the result)
    }


    public function creditInforResponse()
    {
        $xml = <<<XML
        <s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">
   <s:Body>
      <QueryResponse xmlns="http://creditinfo.com/schemas/2012/09/MultiConnector">
         <QueryResult xmlns:i="http://www.w3.org/2001/XMLSchema-instance">
            <MessageId>a8395472-fd63-4998-b1fe-7b9840104331</MessageId>
            <ResponseXml>
               <response xmlns="http://creditinfo.com/schemas/2012/09/MultiConnector/Messages/Response">
                  <connector id="connectorID">
                     <data id="dataID">
                        <response xmlns="http://creditinfo.com/schemas/2012/09/MultiConnector/Connectors/Bee/Response">
                           <CustomReport>
                              <BouncedCheques/>
                              <Branches>
                                 <NumberOfBranches>0</NumberOfBranches>
                              </Branches>
                              <CIP>
                                 <RecordList>
                                    <Record>
                                       <Date>2023-10-10T13:17:38.8040856Z</Date>
                                       <Grade>XX</Grade>
                                       <ProbabilityOfDefault>100</ProbabilityOfDefault>
                                       <ReasonsList>
                                          <Reason>
                                             <Code>XNOF</Code>
                                             <Description>Subject is not found in database</Description>
                                          </Reason>
                                          <Reason>
                                             <Code>XNOC</Code>
                                             <Description>No contracts in the database</Description>
                                          </Reason>
                                          <Reason>
                                             <Code>XDAT</Code>
                                             <Description>Subject did not have any snapshots in last 36 months</Description>
                                          </Reason>
                                       </ReasonsList>
                                       <Score>999</Score>
                                       <Trend>NoChange</Trend>
                                    </Record>
                                    <Record>
                                       <Date>2023-09-29T21:00:00Z</Date>
                                       <Grade>XX</Grade>
                                       <ProbabilityOfDefault>100</ProbabilityOfDefault>
                                       <ReasonsList>
                                          <Reason>
                                             <Code>XNOF</Code>
                                          </Reason>
                                          <Reason>
                                             <Code>XNOC</Code>
                                          </Reason>
                                          <Reason>
                                             <Code>XDAT</Code>
                                          </Reason>
                                       </ReasonsList>
                                       <Score>999</Score>
                                       <Trend>NoChange</Trend>
                                    </Record>
                                    <Record>
                                       <Date>2023-08-30T21:00:00Z</Date>
                                       <Grade>XX</Grade>
                                       <ProbabilityOfDefault>100</ProbabilityOfDefault>
                                       <ReasonsList>
                                          <Reason>
                                             <Code>XNOF</Code>
                                          </Reason>
                                          <Reason>
                                             <Code>XNOC</Code>
                                          </Reason>
                                          <Reason>
                                             <Code>XDAT</Code>
                                          </Reason>
                                       </ReasonsList>
                                       <Score>999</Score>
                                       <Trend>NoChange</Trend>
                                    </Record>
                                    <Record>
                                       <Date>2023-07-30T21:00:00Z</Date>
                                       <Grade>XX</Grade>
                                       <ProbabilityOfDefault>100</ProbabilityOfDefault>
                                       <ReasonsList>
                                          <Reason>
                                             <Code>XNOF</Code>
                                          </Reason>
                                          <Reason>
                                             <Code>XNOC</Code>
                                          </Reason>
                                          <Reason>
                                             <Code>XDAT</Code>
                                          </Reason>
                                       </ReasonsList>
                                       <Score>999</Score>
                                       <Trend>NoChange</Trend>
                                    </Record>
                                    <Record>
                                       <Date>2023-06-29T21:00:00Z</Date>
                                       <Grade>XX</Grade>
                                       <ProbabilityOfDefault>100</ProbabilityOfDefault>
                                       <ReasonsList>
                                          <Reason>
                                             <Code>XNOF</Code>
                                          </Reason>
                                          <Reason>
                                             <Code>XNOC</Code>
                                          </Reason>
                                          <Reason>
                                             <Code>XDAT</Code>
                                          </Reason>
                                       </ReasonsList>
                                       <Score>999</Score>
                                       <Trend>NoChange</Trend>
                                    </Record>
                                    <Record>
                                       <Date>2023-05-30T21:00:00Z</Date>
                                       <Grade>XX</Grade>
                                       <ProbabilityOfDefault>100</ProbabilityOfDefault>
                                       <ReasonsList>
                                          <Reason>
                                             <Code>XNOF</Code>
                                          </Reason>
                                          <Reason>
                                             <Code>XNOC</Code>
                                          </Reason>
                                          <Reason>
                                             <Code>XDAT</Code>
                                          </Reason>
                                       </ReasonsList>
                                       <Score>999</Score>
                                       <Trend>NoChange</Trend>
                                    </Record>
                                    <Record>
                                       <Date>2023-04-29T21:00:00Z</Date>
                                       <Grade>XX</Grade>
                                       <ProbabilityOfDefault>100</ProbabilityOfDefault>
                                       <ReasonsList>
                                          <Reason>
                                             <Code>XNOF</Code>
                                          </Reason>
                                          <Reason>
                                             <Code>XNOC</Code>
                                          </Reason>
                                          <Reason>
                                             <Code>XDAT</Code>
                                          </Reason>
                                       </ReasonsList>
                                       <Score>999</Score>
                                       <Trend>NoChange</Trend>
                                    </Record>
                                    <Record>
                                       <Date>2023-03-30T21:00:00Z</Date>
                                       <Grade>XX</Grade>
                                       <ProbabilityOfDefault>100</ProbabilityOfDefault>
                                       <ReasonsList>
                                          <Reason>
                                             <Code>XNOF</Code>
                                          </Reason>
                                          <Reason>
                                             <Code>XNOC</Code>
                                          </Reason>
                                          <Reason>
                                             <Code>XDAT</Code>
                                          </Reason>
                                       </ReasonsList>
                                       <Score>999</Score>
                                       <Trend>NoChange</Trend>
                                    </Record>
                                    <Record>
                                       <Date>2023-02-27T21:00:00Z</Date>
                                       <Grade>XX</Grade>
                                       <ProbabilityOfDefault>100</ProbabilityOfDefault>
                                       <ReasonsList>
                                          <Reason>
                                             <Code>XNOF</Code>
                                          </Reason>
                                          <Reason>
                                             <Code>XNOC</Code>
                                          </Reason>
                                          <Reason>
                                             <Code>XDAT</Code>
                                          </Reason>
                                       </ReasonsList>
                                       <Score>999</Score>
                                       <Trend>NoChange</Trend>
                                    </Record>
                                    <Record>
                                       <Date>2023-01-30T21:00:00Z</Date>
                                       <Grade>XX</Grade>
                                       <ProbabilityOfDefault>100</ProbabilityOfDefault>
                                       <ReasonsList>
                                          <Reason>
                                             <Code>XNOF</Code>
                                          </Reason>
                                          <Reason>
                                             <Code>XNOC</Code>
                                          </Reason>
                                          <Reason>
                                             <Code>XDAT</Code>
                                          </Reason>
                                       </ReasonsList>
                                       <Score>999</Score>
                                       <Trend>NoChange</Trend>
                                    </Record>
                                    <Record>
                                       <Date>2022-12-30T21:00:00Z</Date>
                                       <Grade>XX</Grade>
                                       <ProbabilityOfDefault>100</ProbabilityOfDefault>
                                       <ReasonsList>
                                          <Reason>
                                             <Code>XNOF</Code>
                                          </Reason>
                                          <Reason>
                                             <Code>XNOC</Code>
                                          </Reason>
                                          <Reason>
                                             <Code>XDAT</Code>
                                          </Reason>
                                       </ReasonsList>
                                       <Score>999</Score>
                                       <Trend>NoChange</Trend>
                                    </Record>
                                    <Record>
                                       <Date>2022-11-29T21:00:00Z</Date>
                                       <Grade>XX</Grade>
                                       <ProbabilityOfDefault>100</ProbabilityOfDefault>
                                       <ReasonsList>
                                          <Reason>
                                             <Code>XNOF</Code>
                                          </Reason>
                                          <Reason>
                                             <Code>XNOC</Code>
                                          </Reason>
                                          <Reason>
                                             <Code>XDAT</Code>
                                          </Reason>
                                       </ReasonsList>
                                       <Score>999</Score>
                                       <Trend>NoChange</Trend>
                                    </Record>
                                    <Record>
                                       <Date>2022-10-30T21:00:00Z</Date>
                                       <Grade>XX</Grade>
                                       <ProbabilityOfDefault>100</ProbabilityOfDefault>
                                       <ReasonsList>
                                          <Reason>
                                             <Code>XNOF</Code>
                                          </Reason>
                                          <Reason>
                                             <Code>XNOC</Code>
                                          </Reason>
                                          <Reason>
                                             <Code>XDAT</Code>
                                          </Reason>
                                       </ReasonsList>
                                       <Score>999</Score>
                                       <Trend>Up</Trend>
                                    </Record>
                                 </RecordList>
                              </CIP>
                              <CIQ>
                                 <Detail>
                                    <LostStolenRecordsFound>0</LostStolenRecordsFound>
                                    <NumberOfCancelledClosedContracts>0</NumberOfCancelledClosedContracts>
                                    <NumberOfSubscribersMadeInquiriesLast14Days>0</NumberOfSubscribersMadeInquiriesLast14Days>
                                    <NumberOfSubscribersMadeInquiriesLast2Days>0</NumberOfSubscribersMadeInquiriesLast2Days>
                                 </Detail>
                                 <Summary>
                                    <NumberOfFraudAlertsPrimarySubject>0</NumberOfFraudAlertsPrimarySubject>
                                    <NumberOfFraudAlertsThirdParty>0</NumberOfFraudAlertsThirdParty>
                                 </Summary>
                              </CIQ>
                              <ContractOverview/>
                              <ContractSummary>
                                 <AffordabilityHistoryList>
                                    <AffordabilityHistory>
                                       <Month>10</Month>
                                       <MonthlyAffordability>
                                          <Currency>TZS</Currency>
                                          <LocalValue>0</LocalValue>
                                          <Value>0</Value>
                                       </MonthlyAffordability>
                                       <Year>2023</Year>
                                    </AffordabilityHistory>
                                    <AffordabilityHistory>
                                       <Month>9</Month>
                                       <MonthlyAffordability>
                                          <Currency>TZS</Currency>
                                          <LocalValue>0</LocalValue>
                                          <Value>0</Value>
                                       </MonthlyAffordability>
                                       <Year>2023</Year>
                                    </AffordabilityHistory>
                                    <AffordabilityHistory>
                                       <Month>8</Month>
                                       <MonthlyAffordability>
                                          <Currency>TZS</Currency>
                                          <LocalValue>0</LocalValue>
                                          <Value>0</Value>
                                       </MonthlyAffordability>
                                       <Year>2023</Year>
                                    </AffordabilityHistory>
                                    <AffordabilityHistory>
                                       <Month>7</Month>
                                       <MonthlyAffordability>
                                          <Currency>TZS</Currency>
                                          <LocalValue>0</LocalValue>
                                          <Value>0</Value>
                                       </MonthlyAffordability>
                                       <Year>2023</Year>
                                    </AffordabilityHistory>
                                    <AffordabilityHistory>
                                       <Month>6</Month>
                                       <MonthlyAffordability>
                                          <Currency>TZS</Currency>
                                          <LocalValue>0</LocalValue>
                                          <Value>0</Value>
                                       </MonthlyAffordability>
                                       <Year>2023</Year>
                                    </AffordabilityHistory>
                                    <AffordabilityHistory>
                                       <Month>5</Month>
                                       <MonthlyAffordability>
                                          <Currency>TZS</Currency>
                                          <LocalValue>0</LocalValue>
                                          <Value>0</Value>
                                       </MonthlyAffordability>
                                       <Year>2023</Year>
                                    </AffordabilityHistory>
                                    <AffordabilityHistory>
                                       <Month>4</Month>
                                       <MonthlyAffordability>
                                          <Currency>TZS</Currency>
                                          <LocalValue>0</LocalValue>
                                          <Value>0</Value>
                                       </MonthlyAffordability>
                                       <Year>2023</Year>
                                    </AffordabilityHistory>
                                    <AffordabilityHistory>
                                       <Month>3</Month>
                                       <MonthlyAffordability>
                                          <Currency>TZS</Currency>
                                          <LocalValue>0</LocalValue>
                                          <Value>0</Value>
                                       </MonthlyAffordability>
                                       <Year>2023</Year>
                                    </AffordabilityHistory>
                                    <AffordabilityHistory>
                                       <Month>2</Month>
                                       <MonthlyAffordability>
                                          <Currency>TZS</Currency>
                                          <LocalValue>0</LocalValue>
                                          <Value>0</Value>
                                       </MonthlyAffordability>
                                       <Year>2023</Year>
                                    </AffordabilityHistory>
                                    <AffordabilityHistory>
                                       <Month>1</Month>
                                       <MonthlyAffordability>
                                          <Currency>TZS</Currency>
                                          <LocalValue>0</LocalValue>
                                          <Value>0</Value>
                                       </MonthlyAffordability>
                                       <Year>2023</Year>
                                    </AffordabilityHistory>
                                    <AffordabilityHistory>
                                       <Month>12</Month>
                                       <MonthlyAffordability>
                                          <Currency>TZS</Currency>
                                          <LocalValue>0</LocalValue>
                                          <Value>0</Value>
                                       </MonthlyAffordability>
                                       <Year>2022</Year>
                                    </AffordabilityHistory>
                                    <AffordabilityHistory>
                                       <Month>11</Month>
                                       <MonthlyAffordability>
                                          <Currency>TZS</Currency>
                                          <LocalValue>0</LocalValue>
                                          <Value>0</Value>
                                       </MonthlyAffordability>
                                       <Year>2022</Year>
                                    </AffordabilityHistory>
                                 </AffordabilityHistoryList>
                                 <AffordabilitySummary>
                                    <MonthlyAffordability>
                                       <Currency>TZS</Currency>
                                       <LocalValue>0</LocalValue>
                                       <Value>0</Value>
                                    </MonthlyAffordability>
                                 </AffordabilitySummary>
                                 <Debtor>
                                    <ClosedContracts>0</ClosedContracts>
                                    <OpenContracts>0</OpenContracts>
                                 </Debtor>
                                 <Guarantor>
                                    <ClosedContracts>0</ClosedContracts>
                                    <OpenContracts>0</OpenContracts>
                                 </Guarantor>
                                 <Overall>
                                    <MaxDueInstallmentsClosedContracts>0</MaxDueInstallmentsClosedContracts>
                                    <MaxDueInstallmentsOpenContracts>0</MaxDueInstallmentsOpenContracts>
                                    <WorstPastDueAmount>
                                       <Currency>TZS</Currency>
                                       <LocalValue>0</LocalValue>
                                       <Value>0</Value>
                                    </WorstPastDueAmount>
                                    <WorstPastDueDays>0</WorstPastDueDays>
                                 </Overall>
                              </ContractSummary>
                              <Contracts/>
                              <CurrentRelations/>
                              <Dashboard>
                                 <CIP>
                                    <Grade>XX</Grade>
                                    <Score>999</Score>
                                 </CIP>
                                 <CIQ>
                                    <FraudAlerts>0</FraudAlerts>
                                    <FraudAlertsThirdParty>0</FraudAlertsThirdParty>
                                 </CIQ>
                                 <Collaterals>
                                    <HighestCollateralValueType>NotSpecified</HighestCollateralValueType>
                                    <NumberOfCollaterals>0</NumberOfCollaterals>
                                 </Collaterals>
                                 <Disputes>
                                    <ActiveContractDisputes>0</ActiveContractDisputes>
                                    <ActiveSubjectDisputes>2</ActiveSubjectDisputes>
                                    <ClosedContractDisputes>0</ClosedContractDisputes>
                                    <ClosedSubjectDisputes>0</ClosedSubjectDisputes>
                                 </Disputes>
                                 <Inquiries>
                                    <InquiriesForLast12Months>25</InquiriesForLast12Months>
                                 </Inquiries>
                                 <PaymentsProfile>
                                    <WorstPastDueDaysCurrent>0</WorstPastDueDaysCurrent>
                                    <WorstPastDueDaysForLast12Months>0</WorstPastDueDaysForLast12Months>
                                 </PaymentsProfile>
                                 <Relations>
                                    <NumberOfRelations>0</NumberOfRelations>
                                 </Relations>
                              </Dashboard>
                              <Disputes>
                                 <Summary>
                                    <NumberOfActiveDisputesContracts>0</NumberOfActiveDisputesContracts>
                                    <NumberOfActiveDisputesSubjectData>2</NumberOfActiveDisputesSubjectData>
                                    <NumberOfClosedDisputesContracts>0</NumberOfClosedDisputesContracts>
                                    <NumberOfClosedDisputesSubjectData>0</NumberOfClosedDisputesSubjectData>
                                    <NumberOfFalseDisputes>0</NumberOfFalseDisputes>
                                 </Summary>
                              </Disputes>
                              <Individual>
                                 <Contact>
                                    <MobilePhone>+255754509579</MobilePhone>
                                 </Contact>
                                 <General>
                                    <BirthSurname>MBUYA</BirthSurname>
                                    <Citizenship>NotSpecified</Citizenship>
                                    <ClassificationOfIndividual>Individual</ClassificationOfIndividual>
                                    <CountryOfBirth>NotSpecified</CountryOfBirth>
                                    <DateOfBirth>1985-07-22T21:00:00Z</DateOfBirth>
                                    <Education>NotSpecified</Education>
                                    <Employment>NotSpecified</Employment>
                                    <FirstName>JOSEPH</FirstName>
                                    <FullName>JOSEPH  MBUYA</FullName>
                                    <Gender>NotSpecified</Gender>
                                    <MaritalStatus>NotSpecified</MaritalStatus>
                                    <Nationality>TZ</Nationality>
                                    <NegativeStatus>NotSpecified</NegativeStatus>
                                 </General>
                                 <Identifications>
                                    <NationalID>19850723-14125-00004-24</NationalID>
                                    <PassportIssuerCountry>NotSpecified</PassportIssuerCountry>
                                 </Identifications>
                                 <MainAddress>
                                    <AddressLine>Tanzania</AddressLine>
                                    <Country>NotSpecified</Country>
                                 </MainAddress>
                                 <SecondaryAddress>
                                    <Country>NotSpecified</Country>
                                 </SecondaryAddress>
                              </Individual>
                              <Inquiries>
                                 <InquiryList>
                                    <Inquiry>
                                       <DateOfInquiry>2023-03-21T13:44:16.267Z</DateOfInquiry>
                                       <Product>WS Creditinfo Report Plus</Product>
                                       <Reason>1</Reason>
                                       <Sector>Others</Sector>
                                       <Subscriber>Y9Bank</Subscriber>
                                    </Inquiry>
                                    <Inquiry>
                                       <DateOfInquiry>2023-03-21T12:19:23.807Z</DateOfInquiry>
                                       <Product>WS Creditinfo Report Plus</Product>
                                       <Reason>1</Reason>
                                       <Sector>Others</Sector>
                                       <Subscriber>Y9Bank</Subscriber>
                                    </Inquiry>
                                    <Inquiry>
                                       <DateOfInquiry>2023-01-26T07:04:55.347Z</DateOfInquiry>
                                       <Product>WS Creditinfo Report Plus</Product>
                                       <Reason>1</Reason>
                                       <Sector>Banks</Sector>
                                       <Subscriber>SELCOM</Subscriber>
                                    </Inquiry>
                                    <Inquiry>
                                       <DateOfInquiry>2023-01-20T13:46:13.427Z</DateOfInquiry>
                                       <Product>WS Creditinfo Report Plus</Product>
                                       <Reason>1</Reason>
                                       <Sector>Others</Sector>
                                       <Subscriber>Y9Bank</Subscriber>
                                    </Inquiry>
                                    <Inquiry>
                                       <DateOfInquiry>2023-01-17T08:11:23.53Z</DateOfInquiry>
                                       <Product>WS Creditinfo Report Plus</Product>
                                       <Reason>1</Reason>
                                       <Sector>Banks</Sector>
                                       <Subscriber>SELCOM</Subscriber>
                                    </Inquiry>
                                 </InquiryList>
                                 <Summary>
                                    <NumberOfInquiriesLast12Months>25</NumberOfInquiriesLast12Months>
                                    <NumberOfInquiriesLast1Month>0</NumberOfInquiriesLast1Month>
                                    <NumberOfInquiriesLast24Months>25</NumberOfInquiriesLast24Months>
                                    <NumberOfInquiriesLast3Months>0</NumberOfInquiriesLast3Months>
                                    <NumberOfInquiriesLast6Months>0</NumberOfInquiriesLast6Months>
                                 </Summary>
                              </Inquiries>
                              <Managers>
                                 <NumberOfManagers>0</NumberOfManagers>
                              </Managers>
                              <Parameters>
                                 <Consent>true</Consent>
                                 <IDNumber>315972954</IDNumber>
                                 <IDNumberType>CreditinfoId</IDNumberType>
                                 <InquiryReason>ApplicationForCreditOrAmendmentOfCreditTerms</InquiryReason>
                                 <Sections>
                                    <string>CreditinfoReportPlus</string>
                                 </Sections>
                                 <SubjectType>Individual</SubjectType>
                              </Parameters>
                              <ReportInfo>
                                 <Created>2023-10-10T13:17:40.2032992Z</Created>
                                 <ReferenceNumber>2691928-315972954</ReferenceNumber>
                                 <RequestedBy>NMB SMARTTEST</RequestedBy>
                                 <Subscriber>NMBPLC</Subscriber>
                              </ReportInfo>
                              <Shareholders>
                                 <NumberOfShareholders>0</NumberOfShareholders>
                              </Shareholders>
                              <SubjectInfoHistory>
                                 <GeneralList>
                                    <General>
                                       <Item>FullName</Item>
                                       <Subscriber>B01</Subscriber>
                                       <ValidFrom>2021-09-29T21:00:00Z</ValidFrom>
                                       <ValidTo>2021-11-29T21:00:00Z</ValidTo>
                                       <Value>JOSEPH  MBUYA</Value>
                                    </General>
                                    <General>
                                       <Item>FullName</Item>
                                       <Subscriber>B01</Subscriber>
                                       <ValidFrom>2021-11-29T21:00:00Z</ValidFrom>
                                       <ValidTo>2022-03-30T21:00:00Z</ValidTo>
                                       <Value>JOSEPH   MBUYA</Value>
                                    </General>
                                 </GeneralList>
                              </SubjectInfoHistory>
                           </CustomReport>
                           <MultiHit>
                              <message>SingleHit + Report</message>
                           </MultiHit>
                        </response>
                     </data>
                  </connector>
               </response>
            </ResponseXml>
            <Timestamp>2023-10-10T13:17:40.8954032Z</Timestamp>
         </QueryResult>
      </QueryResponse>
   </s:Body>
</s:Envelope>
XML;

        $dom = new DOMDocument();
        $dom->loadXML($xml);


        $xpath = new DOMXPath($dom);
        $xpath->registerNamespace('s', 'http://schemas.xmlsoap.org/soap/envelope/');
        $xpath->registerNamespace('ci', 'http://creditinfo.com/schemas/2012/09/MultiConnector');
        $xpath->registerNamespace('r', 'http://creditinfo.com/schemas/2012/09/MultiConnector/Messages/Response');
        $xpath->registerNamespace('ci2', 'http://creditinfo.com/schemas/2012/09/MultiConnector/Connectors/Bee/Response');


        // XPath expression to select the Individual element
        $individualXPath = '//s:Envelope/s:Body/ci:QueryResponse/ci:QueryResult/ci:ResponseXml/r:response/r:connector/r:data/ci2:response/ci2:CustomReport/ci2:Individual';

        // Query the Individual element
        $individual = $xpath->query($individualXPath)->item(0);

        return $individual;


//
//        $mobilePhone = $xpath->evaluate('string(/s:Envelope/s:Body/ci:QueryResponse/ci:QueryResult/ci:ResponseXml/r:response/r:connector/r:data/ci2:response/ci2:CustomReport/ci2:Individual/ci2:Contact/ci2:MobilePhone)');
//// Number of closed contracts
//        $closedContracts = $xpath->evaluate('number(//s:Envelope/s:Body/ci:QueryResponse/ci:QueryResult/ci:ResponseXml/r:response/r:connector/r:data/ci2:response/ci2:CustomReport/ci2:ContractSummary/ci2:Debtor/ci2:ClosedContracts)');
//
//
//// Number of open contracts
//        $openContracts = $xpath->evaluate('number(//s:Envelope/s:Body/ci:QueryResponse/ci:QueryResult/ci:ResponseXml/r:response/r:connector/r:data/ci2:response/ci2:CustomReport/ci2:ContractSummary/ci2:Debtor/ci2:OpenContracts)');
//
//
//// XPath expression to select all closed contracts
//        $closedContractsXPath = '//s:Envelope/s:Body/ci:QueryResponse/ci:QueryResult/ci:ResponseXml/r:response/r:connector/r:data/ci2:response/ci2:CustomReport/ci2:ContractSummary/ci2:Contracts/ci2:Contract';
//
////// Query all closed contracts
////        $closedContracts = $xpath->query($closedContractsXPath);
////
////
////
////// Iterate through each closed contract
////        foreach ($closedContracts as $contract) {
////            // Extract details for each closed contract
////            $contractDetails = [
////                'ContractNumber' => $xpath->evaluate('string(ci2:ContractNumber)', $contract),
////                // Add more details as needed...
////            ];
////
////
////            // Output details for each closed contract
////            //echo "Contract Number: " . $contractDetails['ContractNumber'] . "\n";
////            // Output other details...
////
////        }
////
////
////
////
////        // XPath expression to select all contracts
////        $allContractsXPath = '//s:Envelope/s:Body/ci:QueryResponse/ci:QueryResult/ci:ResponseXml/r:response/r:connector/r:data/ci2:response/ci2:CustomReport/ci2:ContractSummary/ci2:Contracts/ci2:Contract';
////
////// Query all contracts
////        $allContracts = $xpath->query($allContractsXPath);
////
////// Iterate through each contract
////        foreach ($allContracts as $contract) {
////            // Extract details for each contract
////            $contractDetails = [
////                'ContractNumber' => $xpath->evaluate('string(ci2:ContractNumber)', $contract),
////                'Status' => $xpath->evaluate('string(ci2:Status)', $contract), // Adjust based on actual XML structure
////                'PastDueAmount' => $xpath->evaluate('number(ci2:PastDueAmount)', $contract), // Assuming PastDueAmount is a numeric value
////                // Add more details as needed...
////            ];
////
////            // Determine whether the contract is open or closed
////            $contractStatus = $contractDetails['Status'];
////
////            // Output details for each contract
////            echo "Contract Number: " . $contractDetails['ContractNumber'] . "\n";
////            echo "Status: " . $contractStatus . "\n";
////            // Output other details...
////
////            // Add a separator for better readability
////            echo "--------------------\n";
////        }
////
////
//
//        // XPath expression to select all contracts
//        $allContractsXPath = '//s:Envelope/s:Body/ci:QueryResponse/ci:QueryResult/ci:ResponseXml/r:response/r:connector/r:data/ci2:response/ci2:CustomReport/ci2:ContractSummary/ci2:Contracts';
//        $closedContractsXP = '//s:Envelope/s:Body/ci:QueryResponse/ci:QueryResult/ci:ResponseXml/r:response/r:connector/r:data/ci2:response/ci2:CustomReport/ci2:ContractSummary/ci2:Contracts/ci2:Contract';
//        // Query all contracts
//        $closedContracts = $xpath->query($closedContractsXPath);
//        //dd($closedContracts);
//        // Iterate through each contract
//        foreach ($closedContracts as $contract) {
//
//            // Iterate through all child nodes of the contract
//            foreach ($contract->childNodes as $childNode) {
//                // Output node name and value
//                dd($childNode->nodeValue);
//                echo $childNode->localName . ": " . $childNode->nodeValue . "\n";
//            }
//
//            // Add a separator for better readability
//            echo "--------------------\n";
//        }
//
//
//
//        dd($mobilePhone);
//
//// Get the main response element
//        $responseElement = $xpath->query('//s:Envelope/s:Body/m:QueryResponse/m:QueryResult/m:ResponseXml/r:response')->item(0);
//
//// Check if the response element exists before further processing
//        if ($responseElement) {
//            $xpath->registerNamespace('c', 'http://creditinfo.com/schemas/2012/09/MultiConnector/Connectors/Bee/Response');
//            // Get the Individual element within the response
//            $individualElement = $xpath->query('./r:CustomReport/r:Individual', $responseElement)->item(0);
//            //$individualElement = $xpath->query('.//r:CustomReport/r:BouncedCheques', $responseElement)->item(0);
//            //$individualElement = $xpath->query('./r:CustomReport/r:BouncedCheques', $responseElement)->item(0);
//            //$individualElement = $xpath->query('./r:Individual', $responseElement)->item(0);
//
//            // Register namespaces
//
//            dd(var_dump($individualElement));
//
//
//
//// Get the Grade element within the Record
//            $gradeValue = $xpath->evaluate('string(.//r:response/c:connector/c:data/c:response/c:CustomReport/c:BouncedCheques)', $responseElement);
//
//
//            //$gradeValue = $xpath->evaluate('string(.//r:CustomReport/c:RecordList/c:Record/c:Grade)', $responseElement);
//
//
//
//
//            dd($gradeValue);
//
//            // Check if the Individual element exists before extracting details
//            if ($individualElement) {
//                // Extract details from the Individual element
//                $personDetails = [
//                    'BouncedCheques' => $xpath->evaluate('string(./r:BouncedCheques)', $individualElement),
//                    'FullName' => $xpath->evaluate('string(./r:General/r:FullName)', $individualElement),
//                    'DateOfBirth' => $xpath->evaluate('string(./r:General/r:DateOfBirth)', $individualElement),
//                    'Gender' => $xpath->evaluate('string(./r:General/r:Gender)', $individualElement),
//                    // Add more details as needed...
//                ];
//
//                // Output the details
//                print_r($personDetails);
//            } else {
//                echo "Individual element not found in the response.";
//            }
//        } else {
//            echo "Response element not found in the XML.";
//        }




    }


    public $teller_tab=1;

    /**
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     */
    public function render()
    {


        if($this->interest){
            $this->interest_value=$this->interest;
        }

        if($this->tenure){

        }else{
            $this->tenure = '12';
        }
        if($this->principle){
            LoansModel::where('id', Session::get('currentloanID'))->update([
                'principle' => $this->principle,
                'tenure' => $this->tenure,
                'interest_method'=>$this->interest_method,
                'interest'=>$this->interest,
            ]);
        }


        $this->loan = LoansModel::where('id', Session::get('currentloanID'))->get();


        foreach ($this->loan as $theloan) {

            $this->principle = $theloan->principle;

            $this->tenure = $theloan->tenure;
            $this->interest_method=$theloan->interest_method;


        }


        $this->monthly_sales = (double)$this->daily_sales * (double)$this->days_in_a_month;


        $this->gross_profit = $this->monthly_sales - (double)$this->cost_of_goods_sold;
        $this->net_profit = $this->gross_profit - (double)$this->monthly_taxes;
        $this->available_funds = ($this->net_profit - (double)$this->other_expenses) / 2;

        $interest = $this->interest_value / 12;


        if((session()->get('loanStatus')=="AWAITING APPROVAL") || (session()->get('loanStatus')=="ACTIVE") || session()->get('loanStatus')=="AWAITING DISBURSEMENT" || session()->get('loanStatus')=="REJECTED"  ){

            $payment = $this->calc_payment($this->principle, $this->tenure, $interest, 2);
            $this->print_schedule($this->principle, $interest, $payment);

        }

        else{

            if ($this->recommended) {
                $this->print_schedule($this->principle, $interest, $this->available_funds);
            } else {
                $payment = $this->calc_payment($this->principle, $this->tenure, $interest, 2);
                $this->print_schedule($this->principle, $interest, $payment);
            }
        }




        return view('livewire.profile-setting.profile');
    }

    public function menu_sub_button($id): void
    {
        $this->teller_tab=$id;
    }

    public function nextStep()
    {
        $this->currentStep++;
    }

    public function previousStep()
    {
        $this->currentStep--;
    }

    public function submitForm()
    {
        // Example data to be inserted
        $offerData = [
            'loan_id' => $this->application,
            'principle' => $this->principle,
            'interest' => $this->interest,
            'tenure' => $this->tenure,
            'make_and_model' => $this->make_and_model,
            'purchase_price' => $this->purchase_price,
            'schedule' => json_encode($this->table)
            // Add other columns and their values as needed
        ];

// Insert into the 'offers' table
        DB::table('offers')->insert($offerData);

        $this->showDialog = false;
    }

    public function closeDiag()
    {
        $this->showDialog = false;
    }

















    public function actionBtns($x)
    {
        if ($x == 1) {
            $this->recommended = false;
        }
        if ($x == 2) {
            $this->recommended = true;
        }
        if ($x == 3) {
            $this->commit();
        }
        if ($x == 4) {
            $this->approve();



        }
        if ($x == 5) {
            $this->reject();
        }
        if ($x == 6) {
            $this->disburse();
        }
        if($x==33){
            $this->topUpBoolena=true;
            $this->topUp();
        }if($x==44){
        $this->restructure();
    }
        if($x==55){
            $this->futureInterest=true;
            $this->closeLoan();
        }
    }


    public function commit()
    {
        if ($this->recommended) {

            LoansModel::where('id', Session::get('currentloanID'))->update([
                'principle' => $this->principle,
                'tenure' => $this->recommended_tenure,
                'available_funds'=> $this->available_funds,
                'status'=> 'AWAITING APPROVAL',
                'interest_method'=>$this->interest_method,
            ]);
            Session::flash('loan_commit', 'The loan has been committed!');
            Session::flash('alert-class', 'alert-success');

        } else {

            LoansModel::where('id', Session::get('currentloanID'))->update([
                'principle' => $this->principle,
                'tenure' => $this->tenure,
                'available_funds'=> $this->available_funds,
                'status'=> 'AWAITING APPROVAL',
                'interest_method'=>$this->interest_method,

            ]);

            Session::flash('loan_commit', 'The loan has been committed!');
            Session::flash('alert-class', 'alert-success');
        }

        Session::put('currentloanID',null);
        Session::put('currentloanClient',null);
        $this->emit('currentloanID');

    }


    public function updatedFutureInsteresAmount(){

        if($this->futureInsteresAmount > $this->valueAmmount){
            return $this->futureInsteresAmount= round($this->valueAmmount,2);
        }else{
            return $this->futureInsteresAmount;
        }
    }

    public function closeLoan(){

        $loan_data=LoansModel::where('id',Session::get('currentloanID'))->first();

        LoansModel::where('id',Session::get('currentloanID'))->update(['status'=>"CLOSED"]);


        if($this->future_interests){
            // get total amount to be debited/credited as principle
            $total_principle_amount=loans_schedules::where('loan_id',$loan_data->loan_id)->where('installment_date','>',Carbon::today()->format('Y-m-d'))->sum('principle');

            // get total amount to be debited/credited as interest
            $total_interest_amount=loans_schedules::where('loan_id',$loan_data->loan_id)->where('installment_date','>',Carbon::today()->format('Y-m-d'))->sum('interest');


            // get principle collection account
            $loan_product_account_id=Loan_sub_products::where('sub_product_id',$loan_data->loan_sub_product)->value('collection_account_loan_principle');
            $principle_collection_account=AccountsModel::where('id',$loan_product_account_id)->first();
            $principle_collection_account_number=$principle_collection_account->account_number;
            $principle_collection_prev_balance=$principle_collection_account->balance;


            // get interest account collections
            $loan_product_account_interest_id=Loan_sub_products::where('sub_product_id',$loan_data->loan_sub_product)->value('collection_account_loan_interest');
            $interest_collection_account=AccountsModel::where('id',$loan_product_account_interest_id)->first();
            $interest_collection_account_number=$interest_collection_account->account_number;
            $interest_collection_prev_balance=$interest_collection_account->balance;


            if($this->future_interests=="YES")
            {
                // other process here
                $debit_account_number=$loan_data->loan_account_number;

                // check if there is a balance
                $balance=AccountsModel::where('account_number',$debit_account_number)->value('balance');
                if($balance >= $total_principle_amount ){
                    // debit client account
                    $client_new_balance=(double)$balance-(double)$total_principle_amount;

                    // update amount which is debited
                    AccountsModel::where('account_number',$debit_account_number)->update(['balance'=>$client_new_balance]);


                    // credit section  with no interest
                    $principle_collection_account_new_balance=(double)$total_principle_amount + (double)$principle_collection_prev_balance;
                    // update balance
                    AccountsModel::where('account_number',$principle_collection_account_number )->update(['balance'=>$principle_collection_account_new_balance]);

                    // record on the general ledger
                    $record_on_general_ledger=new general_ledger();
                    //debit
                    $record_on_general_ledger->debit($debit_account_number,$client_new_balance
                        ,$principle_collection_account_number,$total_principle_amount,'loan repayment on close loan option',$loan_data->loan_id);

                    // credit
                    $record_on_general_ledger->credit($principle_collection_account_number,$principle_collection_account_new_balance,
                        $debit_account_number,$total_principle_amount,'loan repayment on close loan option',$loan_data->loan_id);




                    Session::put('currentloanID',null);
                    Session::put('currentloanClient',null);
                    $this->emit('currentloanID');
                }else{

                    session()->flash('message_fail','insufficient balance');
                }

            }
            elseif($this->future_interests=="NO"){
                $this->validate(['futureInsteresAmount'=>'required']);

                // other process here
                $total_interest_amount=$this->futureInsteresAmount;

                // debit user account balance// but check if has enough balance
                // other process here
                $debit_account_number=$loan_data->loan_account_number;

                $total_amount=(double)$total_interest_amount + (double)$total_principle_amount;

                // check if there is a balance
                $balance=AccountsModel::where('account_number',$debit_account_number)->value('balance');
                if($balance >= $total_amount ){

                    // principle transactions

                    // debit client account
                    $client_new_balance=(double)$balance-(double)$total_principle_amount;

                    // update amount which is debited
                    AccountsModel::where('account_number',$debit_account_number)->update(['balance'=>$client_new_balance]);
                    // credit section  with  principle
                    $principle_collection_account_new_balance=(double)$total_principle_amount + (double)$principle_collection_prev_balance;
                    // update balance
                    AccountsModel::where('account_number',$principle_collection_account_number )->update(['balance'=>$principle_collection_account_new_balance]);


                    // record on the general ledger
                    $record_on_general_ledger=new general_ledger();
                    //debit
                    $record_on_general_ledger->debit($debit_account_number,$client_new_balance
                        ,$principle_collection_account_number,$total_principle_amount,'loan repayment on close loan  for principle amount',$loan_data->loan_id);

                    // credit
                    $record_on_general_ledger->credit($principle_collection_account_number,$principle_collection_account_new_balance,
                        $debit_account_number,$total_principle_amount,'loan repayment on close loan for principle amount',$loan_data->loan_id);




                    // interest transactions
                    $client_new_balance=$client_new_balance-(double)$total_interest_amount;
                    //update amount
                    AccountsModel::where('account_number',$debit_account_number)->update(['balance'=>$client_new_balance]);

                    // credit section with interest
                    $interest_collection_new_balance=(double)$interest_collection_prev_balance + (double)$total_interest_amount;
                    // update balance
                    AccountsModel::where('account_number',$interest_collection_account_number)->update(['balance'=>$interest_collection_new_balance]);


                    //debit
                    $record_on_general_ledger->debit($debit_account_number,$client_new_balance
                        ,$interest_collection_account_number,$total_interest_amount,'loan repayment on close loan for interest amount',$loan_data->loan_id);

                    //credit interest
                    $record_on_general_ledger->credit($interest_collection_account_number,$interest_collection_new_balance,
                        $debit_account_number,$total_interest_amount,'loan repayment on close loan for interest amount',$loan_data->loan_id);



                    Session::put('currentloanID',null);
                    Session::put('currentloanClient',null);
                    $this->emit('currentloanID');
                }else{
                    session()->flash('message_fail','insufficient balance');
                }


            }
        }else{
            $this->emit('refreshAssessment');
        }


    }

    public function restructure(){


        $loanData=LoansModel::where('id',Session::get('currentloanID'))->first();
        // get tatol amount remaining

        if(LoansModel::where('loan_status','RESTRUCTURED')->where('restructure_loanId',$loanData->loan_id)->exists()) {

            session()->flash('message_fail','process failed');
        }else{



            $loanSchedules= loans_schedules::where('loan_id',$loanData->loan_id)->where('completion_status','ACTIVE')->get();

            $amount=0;

            foreach ($loanSchedules as $loan){
                $amount=$amount +$loan->installment;
            }


            $loanId=time();

            LoansModel::create([
                'restructure_loanId'=>$loanData->loan_id,
                'loan_id'=>$loanId,
                'loan_account_number'=>$loanData->loan_account_number,
                'loan_sub_product'=>$loanData->loan_sub_product,
                'client_number'=>$loanData->client_number,
                'guarantor'=>$loanData->guarantor,
                'institution_id'=>$loanData->institution_id,
                'branch_id'=>$loanData->branch_id,
                'principle'=>round($amount,2),
                'interest'=>$loanData->interest,
                'business_name'=>$loanData->business_name,
                'business_age'=>$loanData->business_age,
                'business_category'=>$loanData->business_category,
                'business_type'=>$loanData->business_type,
                'business_licence_number'=>$loanData->business_licence_number,
                'business_tin_number'=>$loanData->business_tin_number,
                'business_inventory'=>$loanData->business_inventory,
                'cash_at_hand'=>$loanData->cash_at_hand,
                'daily_sales'=>$loanData->daily_sales,
                'cost_of_goods_sold'=>$loanData->cost_of_goods_sold,
                'available_funds'=>$loanData->available_funds,
                'operating_expenses'=>$loanData->operating_expenses,
                'monthly_taxes'=>$loanData->monthly_taxes,
                'other_expenses'=>$loanData->other_expenses,
                'collateral_value'=>$loanData->collateral_value,
                'collateral_location'=>$loanData->collateral_location,
                'collateral_description'=>$loanData->collateral_description,
                'collateral_type'=>$loanData->collateral_type,
                'tenure'=>$loanData->tenure,
                'principle_amount'=>round($amount,2),
                'bank_account_number'=>$loanData->bank_account_number,
                'bank'=>$loanData->bank,
                'LoanPhoneNo'=>$loanData->LoanPhoneNo,
                'status'=>"ONPROGRESS",
                'loan_status'=>"RESTRUCTURED",
                'heath'=>'GOOD',
                'phone_number'=>$loanData->phone_number,
                'pay_method'=>$loanData->pay_method,
                'days_in_arrears'=>0,
                'supervisor_id'=>$loanData->supervisor_id,
                'client_id'=>$loanData->client_id,
                'relationship'=>$loanData->relationship,
                'loan_type'=>$loanData->loan_type,


            ]);
            Session::put('currentloanID',null);
            Session::put('currentloanClient',null);
            $this->emit('currentloanID');

        }




    }


    public function topUp(){

        $this->validate(['new_principle'=>'required']);
        $loanData=LoansModel::where('id',Session::get('currentloanID'))->first();
        // get tatol amount remaining


        if(LoansModel::where('loan_status','TOPUP')->where('restructure_loanId',$loanData->loan_id)->exists()) {

            session()->flash('message_fail','process failed');
        }else {

            $loanSchedules = loans_schedules::where('loan_id', $loanData->loan_id)->where('completion_status', 'ACTIVE')->get();

            $amount=0;

            foreach ($loanSchedules as $loan){
                $amount=$amount +$loan->principle;
            }


            if( $this->new_principle > $amount){



                $loanId = time();

                LoansModel::create([
                    'future_interest'=>$this->futureInsteresAmount,
                    'total_principle'=>$amount,
                    'restructure_loanId' => $loanData->loan_id,
                    'loan_id' => $loanId,
                    'loan_account_number' => $loanData->loan_account_number,
                    'loan_sub_product' => $loanData->loan_sub_product,
                    'client_number' => $loanData->client_number,
                    'guarantor' => $loanData->guarantor,
                    'institution_id' => $loanData->institution_id,
                    'branch_id' => $loanData->branch_id,
                    'principle' => $this->new_principle,
                    'interest' => $loanData->interest,
                    'business_name' => $loanData->business_name,
                    'business_age' => $loanData->business_age,
                    'business_category' => $loanData->business_category,
                    'business_type' => $loanData->business_type,
                    'business_licence_number' => $loanData->business_licence_number,
                    'business_tin_number' => $loanData->business_tin_number,
                    'business_inventory' => $loanData->business_inventory,
                    'cash_at_hand' => $loanData->cash_at_hand,
                    'daily_sales' => $loanData->daily_sales,
                    'cost_of_goods_sold' => $loanData->cost_of_goods_sold,
                    'available_funds' => $loanData->available_funds,
                    'operating_expenses' => $loanData->operating_expenses,
                    'monthly_taxes' => $loanData->monthly_taxes,
                    'other_expenses' => $loanData->other_expenses,
                    'collateral_value' => $loanData->collateral_value,
                    'collateral_location' => $loanData->collateral_location,
                    'collateral_description' => $loanData->collateral_description,
                    'collateral_type' => $loanData->collateral_type,
                    'tenure' => $loanData->tenure,
                    'principle_amount' => $this->new_principle,
                    'bank_account_number' => $loanData->bank_account_number,
                    'bank' => $loanData->bank,
                    'LoanPhoneNo' => $loanData->LoanPhoneNo,
                    'status' => "ONPROGRESS",
                    'loan_status' => "TOPUP",
                    'heath' => 'GOOD',
                    'phone_number' => $loanData->phone_number,
                    'pay_method' => $loanData->pay_method,
                    'days_in_arrears' => 0,
                    'supervisor_id' => $loanData->supervisor_id,
                    'client_id' => $loanData->client_id,
                    'relationship' => $loanData->relationship,
                    'loan_type' => $loanData->loan_type,


                ]);


                Session::put('currentloanID',null);
                Session::put('currentloanClient',null);
                $this->emit('currentloanID');
            }else{
                session()->flash('message_fail','invalid amount');
            }
        }


    }

    public function approve(){


        // CREATE LOAN ACCOUNT
        $loan=  LoansModel::where('id',session()->get('currentloanID'))->first();

        $client_email=ClientsModel::where('client_number',$loan->client_number)->first();
        $client_name=$client_email->first_name.' '.$client_email->middle_name.' '.$client_email->last_name;
        $officer_phone_number=Employee::where('id',$client_email->loan_officer)->value('email');

        Mail::to($client_email->email)->send(new LoanProgress($officer_phone_number,$client_name,'Your loan has been approved! We are now finalizing the disbursement process'));


        if(LoansModel::where('id',session()->get('currentloanID'))->value('loan_status')=="RESTRUCTURED"){

            loans_schedules::where('loan_id',$loan->restructure_loanId)->where('completion_status','ACTIVE')->update([
                'completion_status'=>'CLOSED',
                'account_status'=>'CLOSED'
            ]);


            //  LoansModel::where('id',session()->get('currentloanID'))->update(['status'=>"CLOSED"]);
            // source account number

            $next_due_date = Carbon::now()->toDateTimeString();

            foreach ($this->table as $installment) {
                $next_due_date = date('Y-m-d', strtotime($next_due_date. ' +30 days'));
                $product = new loans_schedules;
                $product->loan_id = $loan->loan_id;
                $product->installment = $installment['Payment'];
                $product->interest = $installment['Interest'];
                $product->principle = $installment['Principle'];
                $product->balance = $installment['balance'];
                $product->bank_account_number = $loan->bank1;
                $product->completion_status = "ACTIVE";
                $product->account_status = "ACTIVE";
                $product->installment_date = $next_due_date;
                $product->save();
            }

            foreach ($this->tablefooter as $installment) {
                $next_due_date = date('Y-m-d', strtotime($next_due_date. ' +30 days'));
                $product = new loans_summary;
                $product->loan_id = $loan->loan_id;
                $product->installment = $installment['Payment'];
                $product->interest = $installment['Interest'];
                $product->principle = $installment['Principle'];
                $product->balance = $installment['balance'];
                $product->bank_account_number = $loan->bank1;
                $product->completion_status = "ACTIVE";
                $product->account_status = "ACTIVE";
                $product->save();
            }



            LoansModel::where('id', Session::get('currentloanID'))->update([
                'status'=> 'AWAITING DISBURSEMENT',
//
            ]);



        }


        elseif(LoansModel::where('id',session()->get('currentloanID'))->value('loan_status')=="TOPUP"){
            // top up process here  TOPUP

            $loanValues=LoansModel::where('id',session()->get('currentloanID'))->where('loan_status','TOPUP')->first();


            //principle
            $prev_loan=$loanValues->restructure_loanId;
// close loan
            LoansModel::where('loan_id',$loanValues->restructure_loanId)->update(['status'=>"CLOSED"]);

            // close installment
            loans_schedules::where('loan_id',$prev_loan)->update(['completion_status'=>'CLOSED']);

            $next_due_date = Carbon::now()->toDateTimeString();

            foreach ($this->table as $installment) {
                $next_due_date = date('Y-m-d', strtotime($next_due_date. ' +30 days'));
                $product = new loans_schedules;
                $product->loan_id = $loan->loan_id;
                $product->installment = $installment['Payment'];
                $product->interest = $installment['Interest'];
                $product->principle = $installment['Principle'];
                $product->balance = $installment['balance'];
                $product->bank_account_number = $loan->bank1;
                $product->completion_status = "ACTIVE";
                $product->account_status = "ACTIVE";
                $product->installment_date = $next_due_date;
                $product->save();
            }

            foreach ($this->tablefooter as $installment) {
                $next_due_date = date('Y-m-d', strtotime($next_due_date. ' +30 days'));
                $product = new loans_summary;
                $product->loan_id = $loan->loan_id;
                $product->installment = $installment['Payment'];
                $product->interest = $installment['Interest'];
                $product->principle = $installment['Principle'];
                $product->balance = $installment['balance'];
                $product->bank_account_number = $loan->bank1;
                $product->completion_status = "ACTIVE";
                $product->account_status = "ACTIVE";
                $product->save();
            }



            LoansModel::where('id', Session::get('currentloanID'))->update([
                'status'=> 'AWAITING DISBURSEMENT',
//
            ]);





            Session::flash('loan_commit', 'The loan has been Approved!');
            Session::flash('alert-class', 'alert-success');

            Session::put('currentloanID',null);
            Session::put('currentloanClient',null);
            $this->emit('currentloanID');


        }


        else{

            $next_due_date = Carbon::now()->toDateTimeString();

            foreach ($this->table as $installment) {
                $next_due_date = date('Y-m-d', strtotime($next_due_date. ' +30 days'));
                $product = new loans_schedules;
                $product->loan_id = $loan->loan_id;
                $product->installment = $installment['Payment'];
                $product->interest = $installment['Interest'];
                $product->principle = $installment['Principle'];
                $product->balance = $installment['balance'];
                $product->bank_account_number = $loan->bank1;
                $product->completion_status = "ACTIVE";
                $product->account_status = "ACTIVE";
                $product->installment_date = $next_due_date;
                $product->save();
            }

            foreach ($this->tablefooter as $installment) {
                $next_due_date = date('Y-m-d', strtotime($next_due_date. ' +30 days'));
                $product = new loans_summary;
                $product->loan_id = $loan->loan_id;
                $product->installment = $installment['Payment'];
                $product->interest = $installment['Interest'];
                $product->principle = $installment['Principle'];
                $product->balance = $installment['balance'];
                $product->bank_account_number = $loan->bank1;
                $product->completion_status = "ACTIVE";
                $product->account_status = "ACTIVE";
                $product->save();
            }

            LoansModel::where('id', Session::get('currentloanID'))->update([
                'status'=> 'AWAITING DISBURSEMENT',

            ]);


        }

        Session::flash('loan_commit', 'The loan has been Approved!');
        Session::flash('alert-class', 'alert-success');

        Session::put('currentloanID',null);
        Session::put('currentloanClient',null);
        $this->emit('currentloanID');
    }

    public function reject(){
        LoansModel::where('id', Session::get('currentloanID'))->update([
            'status'=> 'REJECTED'
        ]);
        ClientsModel::where('id',DB::table('loans')->where('id',Session::get('currentloanID'))->value('client_id'))->update([
            'client_status'=> 'REJECTED',
        ]);

        Session::flash('loan_commit', 'The loan has been Rejected!');
        Session::flash('alert-class', 'alert-danger');

        Session::put('currentloanID',null);
        Session::put('currentloanClient',null);
        $this->emit('currentloanID');
    }












    function calc_principal($payno, $int, $pmt)
    {
// check that required values have been supplied
        if (empty($payno)) {
            echo "<p class='error'>a value for NUMBER of PAYMENTS is required</p>";
            exit;
        } // if
        if (empty($int)) {
            echo "<p class='error'>a value for INTEREST RATE is required</p>";
            exit;
        } // if
        if (empty($pmt)) {
            echo "<p class='error'>a value for PAYMENT is required</p>";
            exit;
        } // if

// now do the calculation using this formula:

//******************************************
//             ((1 + INT) ** PAYNO) - 1
// PV = PMT * --------------------------
//            INT * ((1 + INT) ** PAYNO)
//******************************************

        $int = $int / 100;        //convert to percentage
        $value1 = (pow((1 + $int), $payno)) - 1;
        $value2 = $int * pow((1 + $int), $payno);
        $pv = $pmt * ($value1 / $value2);
        $pv = number_format($pv, 2, ".", "");

        return $pv;

    } // calc_principal ==================================================================


    function calc_number($pv, $int, $pmt)
    {
// check that required values have been supplied
        if (empty($pv)) {
            echo "<p class='error'>a value for PRINCIPAL is required</p>";
            exit;
        } // if
        if (empty($int)) {
            echo "<p class='error'>a value for INTEREST RATE is required</p>";
            exit;
        } // if
        if (empty($pmt)) {
            echo "<p class='error'>a value for PAYMENT is required</p>";
            exit;
        } // if

// now do the calculation using this formula:

//******************************************
//         log(1 - INT * PV/PMT)
// PAYNO = ---------------------
//             log(1 + INT)
//******************************************

        $int = $int / 100;
        $value1 = log(1 - $int * ($pv / $pmt));
        $value2 = log(1 + $int);
        $payno = $value1 / $value2;
        $payno = abs($payno);
        $payno = number_format($payno, 0, ".", "");

        return $payno;

    } // calc_number =====================================================================

    function calc_rate($pv, $payno, $pmt)
    {
// check that required values have been supplied
        if (empty($pv)) {
            echo "<p class='error'>a value for PRINCIPAL is required</p>";
            exit;
        } // if
        if (empty($payno)) {
            echo "<p class='error'>a value for NUMBER of PAYMENTS is required</p>";
            exit;
        } // if
        if (empty($pmt)) {
            echo "<p class='error'>a value for PAYMENT is required</p>";
            exit;
        } // if

// now try and guess the value using the binary chop technique
        $GuessHigh = (float)100;    // maximum value
        $GuessMiddle = (float)2.5;    // first guess
        $GuessLow = (float)0;      // minimum value
        $GuessPMT = (float)0;      // result of test calculation

        do {
            // use current value for GuessMiddle as the interest rate,
            // and set level of accurracy to 6 decimal places
            $GuessPMT = (float)calc_payment($pv, $payno, $GuessMiddle, 6);

            if ($GuessPMT > $pmt) {    // guess is too high
                $GuessHigh = $GuessMiddle;
                $GuessMiddle = $GuessMiddle + $GuessLow;
                $GuessMiddle = $GuessMiddle / 2;
            } // if

            if ($GuessPMT < $pmt) {    // guess is too low
                $GuessLow = $GuessMiddle;
                $GuessMiddle = $GuessMiddle + $GuessHigh;
                $GuessMiddle = $GuessMiddle / 2;
            } // if

            if ($GuessMiddle == $GuessHigh) break;
            if ($GuessMiddle == $GuessLow) break;

            $int = number_format($GuessMiddle, 9, ".", "");    // round it to 9 decimal places
            if ($int == 0) {
                echo "<p class='error'>Interest rate has reached zero - calculation error</p>";
                exit;
            } // if

        } while ($GuessPMT !== $pmt);

        return $int;

    } // calc_rate =======================================================================

    function calc_payment($pv, $payno, $int, $accuracy)
    {
        if($pv){

        }else{
            $pv = 0;
        }

        if($int == 0){
           $int = 1;
        }

        //dd($pv, $payno, $int, $accuracy);

// now do the calculation using this formula:

//******************************************
//            INT * ((1 + INT) ** PAYNO)
// PMT = PV * --------------------------
//             ((1 + INT) ** PAYNO) - 1
//******************************************

        $int = $int / 100;    // convert to a percentage
        $value1 = $int * pow((1 + $int), $payno);
        $value2 = pow((1 + $int), $payno) - 1;
        $pmt = $pv * ($value1 / $value2);
// $accuracy specifies the number of decimal places required in the result
        $pmt = number_format($pmt, $accuracy, ".", "");

        return $pmt;

    } // calc_payment ====================================================================

    function print_schedulex($balance, $rate, $payment, $totPayment, $totInterest, $totPrincipal)
    {
        // check that required values have been supplied
        if (empty($balance)) {
            echo "<p class='error'>a value for PRINCIPAL is required</p>";
            exit;
        } // if
        if (empty($rate)) {
            echo "<p class='error'>a value for INTEREST RATE is required</p>";
            exit;
        } // if
        if (empty($payment)) {
            echo "<p class='error'>a value for PAYMENT is required</p>";
            exit;
        } // if

        echo '<table border="1">';
        echo '<colgroup align="right" width="20">';
        echo '<colgroup align="right" width="115">';
        echo '<colgroup align="right" width="115">';
        echo '<colgroup align="right" width="115">';
        echo '<colgroup align="right" width="115">';
        echo '<tr><th>#</th><th>PAYMENT</th><th>INTEREST</th><th>PRINCIPAL</th><th>BALANCE</th></tr>';

        $count = 0;
        do {
            $count++;

            // calculate interest on outstanding balance
            $interest = $balance * $rate / 100;

            // what portion of payment applies to principal?
            $principal = $payment - $interest;

            // watch out for balance < payment
            if ($balance < $payment) {
                $principal = $balance;
                $payment = $interest + $principal;
            } // if

            // reduce balance by principal paid
            $balance = $balance - $principal;

            // watch for rounding error that leaves a tiny balance
            if ($balance < 0) {
                $principal = $principal + $balance;
                $interest = $interest - $balance;
                $balance = 0;
            } // if

            echo "<tr>";
            echo "<td>$count</td>";
            echo "<td>" . number_format($payment, 2, ".", ",") . "</td>";
            echo "<td>" . number_format($interest, 2, ".", ",") . "</td>";
            echo "<td>" . number_format($principal, 2, ".", ",") . "</td>";
            echo "<td>" . number_format($balance, 2, ".", ",") . "</td>";
            echo "</tr>";

            @$totPayment = $totPayment + $payment;
            @$totInterest = $totInterest + $interest;
            @$totPrincipal = $totPrincipal + $principal;
            if ($payment < $interest) {
                echo "</table>";
                echo "<p>Payment < Interest amount - rate is too high, or payment is too low</p>";
                exit;
            } // if
        } while ($balance > 0);
        echo "<tr>";
        echo "<td>&nbsp;</td>";
        echo "<td><b>" . number_format($totPayment, 2, ".", ",") . "</b></td>";
        echo "<td><b>" . number_format($totInterest, 2, ".", ",") . "</b></td>";
        echo "<td><b>" . number_format($totPrincipal, 2, ".", ",") . "</b></td>";
        echo "<td>&nbsp;</td>";
        echo "</tr>";
        echo "</table>";

    } // print_schedule ==================================================================



    function print_schedule($balance, $rate, $payment)
    {


        $totPayment =0;
        $totInterest =0;
        $totPrincipal =0;
        $datalist = array();
        $count = 0;


        if($rate <=0){
            $rate=12;
        }

        if($balance){

        }else{
            $balance = 0;
        }
        if($payment > 0){

        }else{
            $payment = 0;
        }



        if($this->interest_method=="decline_balance"){
            while($balance > 0) {
                $count++;

                // calculate interest on outstanding balance
                $interest = $balance * $rate / 100;

                // what portion of payment applies to principal?
                $principal = $payment - $interest;

                // watch out for balance < payment
                if ($balance < $payment) {
                    $principal = $balance;
                    $payment = $interest + $principal;
                } // if

                // reduce balance by principal paid
                if($principal < 0 ){
                    $balance = 0;
                }else{
                    $balance = $balance - $principal;
                }


                // watch for rounding error that leaves a tiny balance
                if ($balance < 0) {
                    $principal = $principal + $balance;
                    $interest = $interest - $balance;
                    $balance = 0;
                } // if


//   dd($payment,$interest,$principal,$balance);

                $datalist[] = array(
                    "Payment" => $payment,
                    "Interest" => $interest,
                    "Principle" => $principal,
                    "balance" => $balance
                );




                @$totPayment = $totPayment + $payment;

                @$totInterest = $totInterest + $interest;

                @$totPrincipal = $totPrincipal + $principal;



                if ($payment < $interest) {

                } // if

            }

        }



        elseif($this->interest_method=="flat"){

            // calculate interest on outstanding balance
            $interest = $balance * $rate / 100;
            while($balance > 0) {

                $count++ ;

                // what portion of payment applies to principal?
                $principal = $payment - $interest;

                // watch out for balance < payment
                if ($balance < $payment) {
                    $principal = $balance;
                    $payment = $interest + $principal;
                } // if

                // reduce balance by principal paid
                if($principal < 0 ){
                    $balance = 0;
                }else{
                    $balance = $balance - $principal;
                }


                // watch for rounding error that leaves a tiny balance
                if ($balance < 0) {
                    $principal = $principal + $balance;
                    $interest = $interest - $balance;
                    $balance = 0;
                } // if


//   dd($payment,$interest,$principal,$balance);

                $datalist[] = array(
                    "Payment" => $payment,
                    "Interest" => $interest,
                    "Principle" => $principal,
                    "balance" => $balance
                );




                @$totPayment = $totPayment + $payment;

                @$totInterest = $totInterest + $interest;

                @$totPrincipal = $totPrincipal + $principal;



                if ($payment < $interest) {

                } // if

            }

        }



        $datalistfooter[] = array(
            "Payment" => $totPayment,
            "Interest" => $totInterest,
            "Principle" => $totPrincipal,
            "balance" => $balance
        );




        $this->table = $datalist;
        $this->tablefooter = $datalistfooter;
        $this->recommended_tenure = $count;
        $this->recommended_installment = $payment;


    } // print_schedule ==================================================================






}
