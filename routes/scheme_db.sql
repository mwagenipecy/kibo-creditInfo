--
-- Complete Merged PostgreSQL Database Schema
-- Final consolidated version with all enhancements and features
--

-- Dumped from database version 17.4 / 16.9 / 16.1
-- Enterprise loan management system with complete functionality

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: uuid-ossp; Type: EXTENSION; Schema: -; Owner: -
--

CREATE EXTENSION IF NOT EXISTS "uuid-ossp" WITH SCHEMA public;

--
-- Name: EXTENSION "uuid-ossp"; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION "uuid-ossp" IS 'generate universally unique identifiers (UUIDs)';

--
-- Name: get_loan_statistics(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.get_loan_statistics() RETURNS json
    LANGUAGE plpgsql
    AS $$
DECLARE
    result JSON;
BEGIN
    SELECT json_build_object(
        'total_applications', COUNT(*),
        'pending_applications', COUNT(CASE WHEN status = 'Pending' THEN 1 END),
        'approved_applications', COUNT(CASE WHEN status = 'Approved' THEN 1 END),
        'rejected_applications', COUNT(CASE WHEN status = 'Rejected' THEN 1 END),
        'total_amount', COALESCE(SUM(amount::BIGINT), 0),
        'average_amount', COALESCE(AVG(amount::BIGINT), 0),
        'average_score', COALESCE(AVG(score::INTEGER), 0)
    ) INTO result
    FROM loan_applications;
    
    RETURN result;
END;
$$;

ALTER FUNCTION public.get_loan_statistics() OWNER TO postgres;

--
-- Name: update_updated_at_column(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.update_updated_at_column() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
BEGIN
   NEW.updated_at = NOW();
   RETURN NEW;
END;
$$;

ALTER FUNCTION public.update_updated_at_column() OWNER TO postgres;

SET default_tablespace = '';
SET default_table_access_method = heap;

--
-- Name: application_status_log; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.application_status_log (
    id uuid DEFAULT gen_random_uuid() NOT NULL,
    application_id character varying NOT NULL,
    old_status character varying(50),
    new_status character varying(50) NOT NULL,
    changed_by character varying(255) NOT NULL,
    changed_at timestamp without time zone NOT NULL,
    comments text,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE public.application_status_log OWNER TO postgres;

--
-- Name: balance_sheets; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.balance_sheets (
    id character varying(50) DEFAULT public.uuid_generate_v4() NOT NULL,
    financial_year_id character varying(50),
    cash_in_hand_bank bigint,
    trade_other_receivable bigint,
    prepaid_lease bigint,
    inventories bigint,
    income_tax_recoverable bigint,
    total_current_assets bigint,
    fixed_assets_net bigint,
    total_assets bigint,
    trade_other_payables bigint,
    overdraft_facility bigint,
    current_portion_term_loan bigint,
    other_liabilities bigint,
    total_current_liabilities bigint,
    non_current_liabilities bigint,
    total_liabilities bigint,
    share_capital bigint,
    share_premium bigint,
    capital_reserve bigint,
    accumulated_losses bigint,
    total_equity bigint
);

ALTER TABLE public.balance_sheets OWNER TO postgres;

--
-- Name: branches; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.branches (
    id character varying NOT NULL,
    branch_name character varying,
    company_id character varying,
    added_date character varying,
    added_by character varying
);

ALTER TABLE public.branches OWNER TO postgres;

--
-- Name: cash_flows; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cash_flows (
    id character varying(50) DEFAULT public.uuid_generate_v4() NOT NULL,
    financial_year_id character varying(50),
    profit_before_interest_tax bigint,
    depreciation bigint,
    ebit bigint,
    change_in_debtors bigint,
    change_in_stocks bigint,
    change_in_overdraft bigint,
    change_in_creditors bigint,
    net_operating_cash_flow bigint,
    total_debt bigint,
    interest_expense bigint,
    cash_flow_interest_cover numeric(10,2)
);

ALTER TABLE public.cash_flows OWNER TO postgres;

--
-- Name: companies; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.companies (
    id character varying NOT NULL,
    company_name character varying NOT NULL,
    company_code character varying,
    added_date character varying,
    added_by character varying,
    status character varying(50) DEFAULT 'Pending'::character varying
);

ALTER TABLE public.companies OWNER TO postgres;

--
-- Name: company_application; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.company_application (
    id uuid NOT NULL,
    user_id character varying(255) NOT NULL,
    company_id character varying(255) NOT NULL,
    approval_status character varying(255) DEFAULT 'pending'::character varying NOT NULL,
    approval_date timestamp without time zone,
    CONSTRAINT company_application_approval_status_check CHECK (((approval_status)::text = ANY ((ARRAY['pending'::character varying, 'approved'::character varying, 'rejected'::character varying])::text[])))
);

ALTER TABLE public.company_application OWNER TO postgres;

--
-- Name: company_directors; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.company_directors (
    id uuid DEFAULT gen_random_uuid() NOT NULL,
    company_id character varying(255) NOT NULL,
    name character varying(255) NOT NULL,
    is_active boolean DEFAULT true,
    email character varying(255),
    director_role character varying(100),
    director_id_number character varying(100),
    director_since date,
    other_companies text,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE public.company_directors OWNER TO postgres;

--
-- Name: company_documents; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.company_documents (
    id uuid NOT NULL,
    company_id character varying(255) NOT NULL,
    document_type_label character varying(255) NOT NULL,
    original_file_name character varying(255),
    stored_file_name character varying(255) NOT NULL,
    file_path character varying(512) NOT NULL,
    mime_type character varying(100),
    file_size integer,
    uploaded_by character varying(255),
    uploaded_date timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE public.company_documents OWNER TO postgres;

--
-- Name: company_kyc; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.company_kyc (
    id uuid NOT NULL,
    company_name text NOT NULL,
    number_of_employees integer,
    establishment_date date,
    industry_sector text,
    registration_number text,
    tax_number text,
    physical_address text,
    phone_number text,
    email_address text,
    added_by text,
    added_date timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE public.company_kyc OWNER TO postgres;

--
-- Name: company_rejection_details; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.company_rejection_details (
    id uuid DEFAULT gen_random_uuid() NOT NULL,
    company_id character varying(255) NOT NULL,
    rejection_reason text NOT NULL,
    rejected_by character varying(255),
    rejection_date timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE public.company_rejection_details OWNER TO postgres;

--
-- Name: company_related_entities; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.company_related_entities (
    id uuid DEFAULT gen_random_uuid() NOT NULL,
    company_id character varying(255) NOT NULL,
    related_company_name character varying(255) NOT NULL,
    sector_industry character varying(255),
    email character varying(255),
    key_shareholders text,
    key_directors text,
    key_tin_nida text,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE public.company_related_entities OWNER TO postgres;

--
-- Name: company_shareholders; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.company_shareholders (
    id uuid DEFAULT gen_random_uuid() NOT NULL,
    company_id character varying(255) NOT NULL,
    name character varying(255) NOT NULL,
    is_active boolean DEFAULT true,
    email character varying(255),
    shareholder_role character varying(100),
    shareholder_id_number character varying(100),
    shareholder_since date,
    other_companies_shareholder text,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE public.company_shareholders OWNER TO postgres;

--
-- Name: company_signatories; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.company_signatories (
    id uuid DEFAULT gen_random_uuid() NOT NULL,
    company_id character varying(255) NOT NULL,
    name character varying(255) NOT NULL,
    title character varying(255),
    email character varying(255),
    signatory_role character varying(100),
    signatory_id_number character varying(100),
    signatory_since date,
    signatory_other_companies text,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE public.company_signatories OWNER TO postgres;

--
-- Name: credit_reports; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.credit_reports (
    id uuid DEFAULT gen_random_uuid() NOT NULL,
    loan_id character varying(255) NOT NULL,
    national_id character varying(255) NOT NULL,
    full_name character varying(255),
    phone_number character varying(20),
    message_id character varying(255),
    reference_number character varying(255),
    status character varying(50) DEFAULT 'pending'::character varying,
    response_data jsonb,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE public.credit_reports OWNER TO postgres;

COMMENT ON TABLE public.credit_reports IS 'Stores credit reports fetched from Credit Info API';
COMMENT ON COLUMN public.credit_reports.id IS 'Unique identifier for the credit report';
COMMENT ON COLUMN public.credit_reports.loan_id IS 'Reference to the loan application ID';
COMMENT ON COLUMN public.credit_reports.national_id IS 'National ID of the borrower';
COMMENT ON COLUMN public.credit_reports.full_name IS 'Full name of the borrower';
COMMENT ON COLUMN public.credit_reports.phone_number IS 'Phone number of the borrower';
COMMENT ON COLUMN public.credit_reports.message_id IS 'Message ID from Credit Info API response';
COMMENT ON COLUMN public.credit_reports.reference_number IS 'Reference number from Credit Info API response';
COMMENT ON COLUMN public.credit_reports.status IS 'Status of the credit report (pending, completed, failed)';
COMMENT ON COLUMN public.credit_reports.response_data IS 'Complete JSON response from Credit Info API';
COMMENT ON COLUMN public.credit_reports.created_at IS 'Timestamp when the record was created';
COMMENT ON COLUMN public.credit_reports.updated_at IS 'Timestamp when the record was last updated';

--
-- Name: critical_indicators; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.critical_indicators (
    id character varying(50) DEFAULT public.uuid_generate_v4() NOT NULL,
    financial_year_id character varying(50),
    net_tangible_assets bigint,
    depreciation bigint,
    gross_profit_margin numeric(5,2),
    net_profit_margin numeric(5,2),
    leverage_ratio numeric(10,2),
    debt_ratio numeric(10,2),
    current_ratio numeric(10,2),
    return_on_assets numeric(10,2)
);

ALTER TABLE public.critical_indicators OWNER TO postgres;

--
-- Name: departments; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.departments (
    id uuid DEFAULT gen_random_uuid() NOT NULL,
    department_code character varying(50) NOT NULL,
    department_name character varying(100) NOT NULL,
    description text,
    is_active boolean DEFAULT true,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE public.departments OWNER TO postgres;

--
-- Name: employer_approval_details; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.employer_approval_details (
    id bigint NOT NULL,
    loan_id character varying,
    false_information character varying,
    resignation_tendered character varying,
    disciplinary_issue character varying,
    contract_expired character varying,
    retrenchment_plan character varying,
    approved_by character varying,
    approved_date character varying
);

ALTER TABLE public.employer_approval_details OWNER TO postgres;

--
-- Name: employer_approval_details_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.employer_approval_details_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

ALTER SEQUENCE public.employer_approval_details_id_seq OWNER TO postgres;

--
-- Name: employer_approval_details_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.employer_approval_details_id_seq OWNED BY public.employer_approval_details.id;

--
-- Name: employer_rejection_details; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.employer_rejection_details (
    id character varying NOT NULL,
    loan_id character varying,
    rejected_by character varying,
    reason_of_rejecting character varying,
    rejected_date character varying
);

ALTER TABLE public.employer_rejection_details OWNER TO postgres;

--
-- Name: financial_years; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.financial_years (
    id character varying(50) NOT NULL,
    company_id character varying(50),
    year integer NOT NULL,
    months_in_year integer DEFAULT 12,
    is_audited boolean DEFAULT false,
    added_by character varying(255),
    added_date timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE public.financial_years OWNER TO postgres;

--
-- Name: income_statements; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.income_statements (
    id character varying(50) DEFAULT public.uuid_generate_v4() NOT NULL,
    financial_year_id character varying(50),
    sales bigint,
    cost_of_goods_sold bigint,
    gross_profit bigint,
    other_income bigint,
    total_gross_income bigint,
    operating_expenses bigint,
    profit_before_charges_tax bigint,
    finance_cost bigint,
    finance_income bigint,
    operating_profit_loss bigint,
    taxation bigint,
    net_profit bigint
);

ALTER TABLE public.income_statements OWNER TO postgres;

--
-- Name: loan_applications; Type: TABLE; Schema: public; Owner: postgres
-- Comprehensive table with all fields from all schemas
--

CREATE TABLE public.loan_applications (
    id character varying NOT NULL,
    office_id character varying,
    amount character varying,
    tenure character varying,
    employment_duration character varying,
    employment_contract character varying,
    status character varying DEFAULT 'Pending'::character varying,
    document_uploaded character varying DEFAULT 'No'::character varying,
    employer_approval character varying DEFAULT 'No'::character varying,
    created_date character varying,
    form_document character varying,
    gross_income character varying,
    net_income character varying,
    score character varying,
    grade character varying,
    company_id character varying,
    branch_id character varying,
    user_id character varying,
    request_number character varying,
    uploaded_at character varying,
    product_id character varying,
    loan_type character varying,
    outstanding_balance_letter character varying,
    account_number character varying,
    clearance_letter character varying,
    outstanding_balance character varying,
    buyback_amount character varying,
    bank_statement character varying,
    pay_slip character varying,
    approver character varying,
    assigned_department character varying(100),
    assigned_by character varying(255),
    assigned_at timestamp without time zone,
    updated_by character varying(255),
    updated_at timestamp without time zone,
    status_comments text,
    credit_response xml,
    total_amount_requested character varying,
    loan_purpose character varying
);

ALTER TABLE public.loan_applications OWNER TO postgres;

--
-- Name: product_limit_details; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.product_limit_details (
    id character varying NOT NULL,
    product_id character varying,
    min_amount character varying,
    max_amount character varying,
    min_tenure bigint,
    max_tenure bigint,
    interest_rate bigint,
    processing_fee character varying,
    insurance character varying,
    created_by character varying,
    created_at character varying,
    max_dsr character varying
);

ALTER TABLE public.product_limit_details OWNER TO postgres;

--
-- Name: products; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.products (
    id character varying NOT NULL,
    product_name character varying NOT NULL,
    product_description character varying,
    product_image character varying,
    set_limit character varying,
    created_by character varying,
    created_at character varying,
    status character varying DEFAULT 'Active'::character varying,
    terms_conditions character varying
);

ALTER TABLE public.products OWNER TO postgres;

--
-- Name: ratios; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.ratios (
    id character varying(50) DEFAULT public.uuid_generate_v4() NOT NULL,
    financial_year_id character varying(50),
    cost_of_sales_pct numeric(5,2),
    operating_expenses_pct numeric(5,2),
    gross_profit_margin numeric(5,2),
    net_profit_margin numeric(5,2),
    return_on_equity numeric(10,2),
    return_on_assets numeric(10,2),
    current_ratio numeric(10,2),
    acid_test_ratio numeric(10,2),
    days_in_receivable integer,
    days_in_inventory integer,
    days_in_payable integer,
    debt_equity_ratio numeric(10,2),
    debt_ratio numeric(10,2),
    interest_coverage_ratio numeric(10,2),
    annual_debt_servicing_ratio numeric(10,2),
    internal_growth_rate numeric(10,4),
    sustainable_growth_rate numeric(10,4),
    total_assets_turnover numeric(10,2),
    fixed_assets_turnover numeric(10,2),
    inventory_turnover numeric(10,2)
);

ALTER TABLE public.ratios OWNER TO postgres;

--
-- Name: retained_earnings; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.retained_earnings (
    id character varying(50) DEFAULT public.uuid_generate_v4() NOT NULL,
    financial_year_id character varying(50),
    balance_bf bigint,
    capital_reserve bigint,
    profit_for_year bigint,
    dividend_paid bigint,
    balance_cf bigint
);

ALTER TABLE public.retained_earnings OWNER TO postgres;

--
-- Name: roles; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.roles (
    id character varying NOT NULL,
    role_name character varying NOT NULL,
    created_by character varying NOT NULL,
    created_date character varying NOT NULL
);

ALTER TABLE public.roles OWNER TO postgres;

--
-- Name: scheme_limit; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.scheme_limit (
    id uuid DEFAULT gen_random_uuid() NOT NULL,
    company_id character varying(255) NOT NULL,
    payroll_size numeric(18,2),
    max_dsr numeric(5,2),
    penetration_rate numeric(5,2),
    interest_rate numeric(5,2),
    agreed_repayment_term integer,
    qualifying_amount_per_dsr numeric(18,2),
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE public.scheme_limit OWNER TO postgres;

--
-- Name: statement_analysis; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.statement_analysis (
    id uuid DEFAULT gen_random_uuid() NOT NULL,
    loan_id character varying(255) NOT NULL,
    phone_number character varying(20) NOT NULL,
    status character varying(50) DEFAULT 'pending'::character varying,
    analysis_data jsonb,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE public.statement_analysis OWNER TO postgres;

--
-- Name: supporting_documents; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.supporting_documents (
    id bigint NOT NULL,
    loan_id character varying,
    supporting_document character varying
);

ALTER TABLE public.supporting_documents OWNER TO postgres;

--
-- Name: supporting_documents_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.supporting_documents_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

ALTER SEQUENCE public.supporting_documents_id_seq OWNER TO postgres;

--
-- Name: supporting_documents_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.supporting_documents_id_seq OWNED BY public.supporting_documents.id;

--
-- Name: user_logs; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.user_logs (
    id bigint NOT NULL,
    full_name character varying,
    user_type character varying,
    action character varying,
    action_date_time character varying
);

ALTER TABLE public.user_logs OWNER TO postgres;

--
-- Name: user_logs_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.user_logs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

ALTER SEQUENCE public.user_logs_id_seq OWNER TO postgres;

--
-- Name: user_logs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.user_logs_id_seq OWNED BY public.user_logs.id;

--
-- Name: user_roles; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.user_roles (
    id character varying NOT NULL,
    user_id bigint NOT NULL,
    role_id bigint NOT NULL,
    assigned_by character varying NOT NULL,
    assigned_at character varying NOT NULL
);

ALTER TABLE public.user_roles OWNER TO postgres;

--
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    id character varying NOT NULL,
    full_name character varying NOT NULL,
    email character varying NOT NULL,
    date_of_birth character varying,
    gender character varying,
    id_number character varying,
    marital_status character varying,
    phone_number character varying NOT NULL,
    region character varying,
    district character varying,
    ward character varying,
    street character varying,
    education_level character varying,
    proffession character varying,
    password character varying NOT NULL,
    user_type character varying NOT NULL,
    address_duration character varying,
    address_status character varying,
    status character varying,
    employment_status character varying,
    refresh_token character varying,
    created_at character varying,
    created_by character varying,
    updated_at character varying,
    updated_by character varying,
    approved_at character varying,
    approved_by character varying,
    rejected_at character varying,
    rejected_by character varying,
    disabled_at character varying,
    disabled_by character varying,
    company_id character varying,
    branch_id character varying,
    role character varying,
    email_verified character varying DEFAULT 'No'::character varying
);

ALTER TABLE public.users OWNER TO postgres;

--
-- Name: verification; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.verification (
    id bigint NOT NULL,
    phone_number character varying,
    otp character varying,
    created_date_time character varying
);

ALTER TABLE public.verification OWNER TO postgres;

--
-- Name: verification_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.verification_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

ALTER SEQUENCE public.verification_id_seq OWNER TO postgres;

--
-- Name: verification_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.verification_id_seq OWNED BY public.verification.id;

--
-- Name: application_summary; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.application_summary AS
 SELECT la.id,
    la.amount,
    la.tenure,
    la.status,
    la.employer_approval,
    la.assigned_department,
    la.created_date,
    la.score,
    la.grade,
    la.gross_income,
    la.net_income,
    la.outstanding_balance,
    la.buyback_amount,
    la.total_amount_requested,
    la.loan_purpose,
    u.full_name AS borrower_name,
    u.email,
    u.phone_number,
    p.product_name,
    c.company_name,
    b.branch_name,
        CASE
            WHEN ((la.score)::integer >= 750) THEN 'Excellent'::text
            WHEN ((la.score)::integer >= 700) THEN 'Very Good'::text
            WHEN ((la.score)::integer >= 650) THEN 'Good'::text
            WHEN ((la.score)::integer >= 600) THEN 'Fair'::text
            ELSE 'Poor'::text
        END AS credit_rating
   FROM ((((public.loan_applications la
     LEFT JOIN public.users u ON (((la.user_id)::text = (u.id)::text)))
     LEFT JOIN public.products p ON (((la.product_id)::text = (p.id)::text)))
     LEFT JOIN public.companies c ON (((la.company_id)::text = (c.id)::text)))
     LEFT JOIN public.branches b ON (((la.branch_id)::text = (b.id)::text)));

ALTER VIEW public.application_summary OWNER TO postgres;

--
-- DEFAULT VALUES
--

ALTER TABLE ONLY public.employer_approval_details ALTER COLUMN id SET DEFAULT nextval('public.employer_approval_details_id_seq'::regclass);

ALTER TABLE ONLY public.supporting_documents ALTER COLUMN id SET DEFAULT nextval('public.supporting_documents_id_seq'::regclass);

ALTER TABLE ONLY public.user_logs ALTER COLUMN id SET DEFAULT nextval('public.user_logs_id_seq'::regclass);

ALTER TABLE ONLY public.verification ALTER COLUMN id SET DEFAULT nextval('public.verification_id_seq'::regclass);

--
-- PRIMARY KEY CONSTRAINTS
--

ALTER TABLE ONLY public.application_status_log
    ADD CONSTRAINT application_status_log_pkey PRIMARY KEY (id);

ALTER TABLE ONLY public.balance_sheets
    ADD CONSTRAINT balance_sheets_pkey PRIMARY KEY (id);

ALTER TABLE ONLY public.branches
    ADD CONSTRAINT branches_pkey PRIMARY KEY (id);

ALTER TABLE ONLY public.cash_flows
    ADD CONSTRAINT cash_flows_pkey PRIMARY KEY (id);

ALTER TABLE ONLY public.companies
    ADD CONSTRAINT companies_pkey PRIMARY KEY (id);

ALTER TABLE ONLY public.company_application
    ADD CONSTRAINT company_application_pkey PRIMARY KEY (id);

ALTER TABLE ONLY public.company_directors
    ADD CONSTRAINT company_directors_pkey PRIMARY KEY (id);

ALTER TABLE ONLY public.company_documents
    ADD CONSTRAINT company_documents_pkey PRIMARY KEY (id);

ALTER TABLE ONLY public.company_kyc
    ADD CONSTRAINT company_kyc_pkey PRIMARY KEY (id);

ALTER TABLE ONLY public.company_rejection_details
    ADD CONSTRAINT company_rejection_details_pkey PRIMARY KEY (id);

ALTER TABLE ONLY public.company_related_entities
    ADD CONSTRAINT company_related_entities_pkey PRIMARY KEY (id);

ALTER TABLE ONLY public.company_shareholders
    ADD CONSTRAINT company_shareholders_pkey PRIMARY KEY (id);

ALTER TABLE ONLY public.company_signatories
    ADD CONSTRAINT company_signatories_pkey PRIMARY KEY (id);

ALTER TABLE ONLY public.credit_reports
    ADD CONSTRAINT credit_reports_pkey PRIMARY KEY (id);

ALTER TABLE ONLY public.critical_indicators
    ADD CONSTRAINT critical_indicators_pkey PRIMARY KEY (id);

ALTER TABLE ONLY public.departments
    ADD CONSTRAINT departments_pkey PRIMARY KEY (id);

ALTER TABLE ONLY public.employer_approval_details
    ADD CONSTRAINT employer_approval_details_pkey PRIMARY KEY (id);

ALTER TABLE ONLY public.employer_rejection_details
    ADD CONSTRAINT employer_rejection_details_pkey PRIMARY KEY (id);

ALTER TABLE ONLY public.financial_years
    ADD CONSTRAINT financial_years_pkey PRIMARY KEY (id);

ALTER TABLE ONLY public.income_statements
    ADD CONSTRAINT income_statements_pkey PRIMARY KEY (id);

ALTER TABLE ONLY public.loan_applications
    ADD CONSTRAINT loan_applications_pkey PRIMARY KEY (id);

ALTER TABLE ONLY public.product_limit_details
    ADD CONSTRAINT product_limit_details_pkey PRIMARY KEY (id);

ALTER TABLE ONLY public.products
    ADD CONSTRAINT products_pkey PRIMARY KEY (id);

ALTER TABLE ONLY public.ratios
    ADD CONSTRAINT ratios_pkey PRIMARY KEY (id);

ALTER TABLE ONLY public.retained_earnings
    ADD CONSTRAINT retained_earnings_pkey PRIMARY KEY (id);

ALTER TABLE ONLY public.roles
    ADD CONSTRAINT roles_pkey PRIMARY KEY (id);

ALTER TABLE ONLY public.scheme_limit
    ADD CONSTRAINT scheme_limit_pkey PRIMARY KEY (id);

ALTER TABLE ONLY public.statement_analysis
    ADD CONSTRAINT statement_analysis_pkey PRIMARY KEY (id);

ALTER TABLE ONLY public.supporting_documents
    ADD CONSTRAINT supporting_document_id PRIMARY KEY (id);

ALTER TABLE ONLY public.user_logs
    ADD CONSTRAINT user_logs_pkey PRIMARY KEY (id);

ALTER TABLE ONLY public.user_roles
    ADD CONSTRAINT user_role_id PRIMARY KEY (id);

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);

ALTER TABLE ONLY public.verification
    ADD CONSTRAINT verification_id PRIMARY KEY (id);

--
-- UNIQUE CONSTRAINTS
--

ALTER TABLE ONLY public.company_directors
    ADD CONSTRAINT company_directors_email_key UNIQUE (email);

ALTER TABLE ONLY public.company_documents
    ADD CONSTRAINT company_documents_stored_file_name_key UNIQUE (stored_file_name);

ALTER TABLE ONLY public.company_shareholders
    ADD CONSTRAINT company_shareholders_email_key UNIQUE (email);

ALTER TABLE ONLY public.credit_reports
    ADD CONSTRAINT credit_reports_loan_id_key UNIQUE (loan_id);

ALTER TABLE ONLY public.departments
    ADD CONSTRAINT departments_department_code_key UNIQUE (department_code);

ALTER TABLE ONLY public.statement_analysis
    ADD CONSTRAINT statement_analysis_loan_id_key UNIQUE (loan_id);

ALTER TABLE ONLY public.cash_flows
    ADD CONSTRAINT unique_cash_flows_per_year UNIQUE (financial_year_id);

ALTER TABLE ONLY public.financial_years
    ADD CONSTRAINT unique_company_year UNIQUE (company_id, year);

ALTER TABLE ONLY public.critical_indicators
    ADD CONSTRAINT unique_critical_indicators_per_year UNIQUE (financial_year_id);

ALTER TABLE ONLY public.balance_sheets
    ADD CONSTRAINT unique_fy_balance UNIQUE (financial_year_id);

ALTER TABLE ONLY public.income_statements
    ADD CONSTRAINT unique_income_statement_per_year UNIQUE (financial_year_id);

ALTER TABLE ONLY public.ratios
    ADD CONSTRAINT unique_ratios_per_year UNIQUE (financial_year_id);

ALTER TABLE ONLY public.retained_earnings
    ADD CONSTRAINT unique_retained_earnings_per_year UNIQUE (financial_year_id);

ALTER TABLE ONLY public.scheme_limit
    ADD CONSTRAINT scheme_limit_company_id_key UNIQUE (company_id);

--
-- INDEXES
--

CREATE INDEX idx_application_status_log_app_id ON public.application_status_log USING btree (application_id);

CREATE INDEX idx_credit_reports_created_at ON public.credit_reports USING btree (created_at);

CREATE INDEX idx_credit_reports_loan_id ON public.credit_reports USING btree (loan_id);

CREATE INDEX idx_credit_reports_national_id ON public.credit_reports USING btree (national_id);

CREATE INDEX idx_credit_reports_response_data ON public.credit_reports USING gin (response_data);

CREATE INDEX idx_credit_reports_status ON public.credit_reports USING btree (status);

CREATE INDEX idx_loan_applications_amount ON public.loan_applications USING btree (amount);

CREATE INDEX idx_loan_applications_assigned_dept ON public.loan_applications USING btree (assigned_department);

CREATE INDEX idx_loan_applications_created_date ON public.loan_applications USING btree (created_date);

CREATE INDEX idx_loan_applications_status ON public.loan_applications USING btree (status);

CREATE INDEX idx_loan_applications_user_id ON public.loan_applications USING btree (user_id);

CREATE INDEX idx_loan_applications_company_id ON public.loan_applications USING btree (company_id);

CREATE INDEX idx_loan_applications_product_id ON public.loan_applications USING btree (product_id);

CREATE INDEX idx_statement_analysis_created_at ON public.statement_analysis USING btree (created_at);

CREATE INDEX idx_statement_analysis_loan_id ON public.statement_analysis USING btree (loan_id);

CREATE INDEX idx_statement_analysis_phone ON public.statement_analysis USING btree (phone_number);

CREATE INDEX idx_statement_analysis_status ON public.statement_analysis USING btree (status);

CREATE INDEX idx_users_email ON public.users USING btree (email);

CREATE INDEX idx_users_phone_number ON public.users USING btree (phone_number);

CREATE INDEX idx_users_company_id ON public.users USING btree (company_id);

CREATE INDEX idx_financial_years_company_id ON public.financial_years USING btree (company_id);

CREATE INDEX idx_financial_years_year ON public.financial_years USING btree (year);

CREATE INDEX idx_companies_status ON public.companies USING btree (status);

CREATE INDEX idx_scheme_limit_company_id ON public.scheme_limit USING btree (company_id);

CREATE UNIQUE INDEX unique_user_company ON public.company_application USING btree (user_id, company_id);

--
-- TRIGGERS
--

CREATE TRIGGER update_company_directors_updated_at BEFORE UPDATE ON public.company_directors FOR EACH ROW EXECUTE FUNCTION public.update_updated_at_column();

CREATE TRIGGER update_company_related_entities_updated_at BEFORE UPDATE ON public.company_related_entities FOR EACH ROW EXECUTE FUNCTION public.update_updated_at_column();

CREATE TRIGGER update_company_shareholders_updated_at BEFORE UPDATE ON public.company_shareholders FOR EACH ROW EXECUTE FUNCTION public.update_updated_at_column();

CREATE TRIGGER update_company_signatories_updated_at BEFORE UPDATE ON public.company_signatories FOR EACH ROW EXECUTE FUNCTION public.update_updated_at_column();

CREATE TRIGGER update_credit_reports_updated_at BEFORE UPDATE ON public.credit_reports FOR EACH ROW EXECUTE FUNCTION public.update_updated_at_column();

CREATE TRIGGER update_statement_analysis_updated_at BEFORE UPDATE ON public.statement_analysis FOR EACH ROW EXECUTE FUNCTION public.update_updated_at_column();

CREATE TRIGGER update_scheme_limit_updated_at BEFORE UPDATE ON public.scheme_limit FOR EACH ROW EXECUTE FUNCTION public.update_updated_at_column();

--
-- FOREIGN KEY CONSTRAINTS
--

ALTER TABLE ONLY public.application_status_log
    ADD CONSTRAINT application_status_log_application_id_fkey FOREIGN KEY (application_id) REFERENCES public.loan_applications(id) ON DELETE CASCADE;

ALTER TABLE ONLY public.balance_sheets
    ADD CONSTRAINT balance_sheets_financial_year_id_fkey FOREIGN KEY (financial_year_id) REFERENCES public.financial_years(id);

ALTER TABLE ONLY public.cash_flows
    ADD CONSTRAINT cash_flows_financial_year_id_fkey FOREIGN KEY (financial_year_id) REFERENCES public.financial_years(id);

ALTER TABLE ONLY public.company_directors
    ADD CONSTRAINT company_directors_company_id_fkey FOREIGN KEY (company_id) REFERENCES public.companies(id) ON DELETE CASCADE;

ALTER TABLE ONLY public.company_documents
    ADD CONSTRAINT company_documents_company_id_fkey FOREIGN KEY (company_id) REFERENCES public.companies(id) ON DELETE CASCADE;

ALTER TABLE ONLY public.company_related_entities
    ADD CONSTRAINT company_related_entities_company_id_fkey FOREIGN KEY (company_id) REFERENCES public.companies(id) ON DELETE CASCADE;

ALTER TABLE ONLY public.company_shareholders
    ADD CONSTRAINT company_shareholders_company_id_fkey FOREIGN KEY (company_id) REFERENCES public.companies(id) ON DELETE CASCADE;

ALTER TABLE ONLY public.company_signatories
    ADD CONSTRAINT company_signatories_company_id_fkey FOREIGN KEY (company_id) REFERENCES public.companies(id) ON DELETE CASCADE;

ALTER TABLE ONLY public.critical_indicators
    ADD CONSTRAINT critical_indicators_financial_year_id_fkey FOREIGN KEY (financial_year_id) REFERENCES public.financial_years(id);

ALTER TABLE ONLY public.financial_years
    ADD CONSTRAINT financial_years_company_id_fkey FOREIGN KEY (company_id) REFERENCES public.companies(id);

ALTER TABLE ONLY public.income_statements
    ADD CONSTRAINT income_statements_financial_year_id_fkey FOREIGN KEY (financial_year_id) REFERENCES public.financial_years(id);

ALTER TABLE ONLY public.ratios
    ADD CONSTRAINT ratios_financial_year_id_fkey FOREIGN KEY (financial_year_id) REFERENCES public.financial_years(id);

ALTER TABLE ONLY public.retained_earnings
    ADD CONSTRAINT retained_earnings_financial_year_id_fkey FOREIGN KEY (financial_year_id) REFERENCES public.financial_years(id);

ALTER TABLE ONLY public.company_rejection_details
    ADD CONSTRAINT company_rejection_details_company_id_fkey FOREIGN KEY (company_id) REFERENCES public.companies(id) ON DELETE CASCADE;

ALTER TABLE ONLY public.scheme_limit
    ADD CONSTRAINT scheme_limit_company_id_fkey FOREIGN KEY (company_id) REFERENCES public.companies(id) ON DELETE CASCADE;

--
-- ADDITIONAL COMMENTS FOR DOCUMENTATION
--

COMMENT ON TABLE public.companies IS 'Master table for companies with approval workflow';
COMMENT ON TABLE public.company_application IS 'Tracks user applications to join companies';
COMMENT ON TABLE public.company_rejection_details IS 'Stores detailed rejection reasons for company applications';
COMMENT ON TABLE public.scheme_limit IS 'Company-specific lending scheme parameters and limits';
COMMENT ON TABLE public.loan_applications IS 'Main loan application table with comprehensive workflow';
COMMENT ON TABLE public.application_status_log IS 'Audit trail for loan application status changes';
COMMENT ON TABLE public.statement_analysis IS 'Bank statement analysis results from external APIs';

COMMENT ON COLUMN public.companies.status IS 'Company approval status: Pending, Approved, Rejected';
COMMENT ON COLUMN public.scheme_limit.payroll_size IS 'Total company payroll amount';
COMMENT ON COLUMN public.scheme_limit.max_dsr IS 'Maximum debt service ratio allowed';
COMMENT ON COLUMN public.scheme_limit.penetration_rate IS 'Lending penetration rate for the company';
COMMENT ON COLUMN public.scheme_limit.qualifying_amount_per_dsr IS 'Maximum loan amount based on DSR calculation';

--
-- END OF COMPLETE MERGED SCHEMA
-- Total Tables: 33
-- Total Views: 1
-- Total Database Objects: 34
--