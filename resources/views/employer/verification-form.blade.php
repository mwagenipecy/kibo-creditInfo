@extends('layouts.employer')

@section('content')

<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="bg-green-600 px-6 py-4">
            <h1 class="text-white text-xl font-semibold">Employee Verification Request</h1>
        </div>
        
        <div class="p-6">
            <div class="mb-6 border-b pb-4">
                <h2 class="text-lg font-medium text-gray-900 mb-2">Employee Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-600">Full Name</p>
                        <p class="font-medium">{{ $application->full_name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Employee ID</p>
                        <p class="font-medium">{{ $application->employee_id }}</p>
                    </div>
                </div>
            </div>
            
            <form method="POST" action="{{ route('employer.verification.submit', ['token' => $verification->token]) }}">
                @csrf
                
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Do you recognize this person as an employee at your organization?</label>
                        <div class="mt-2 space-x-4">
                            <label class="inline-flex items-center">
                                <input type="radio" name="knows_employee" value="yes" class="form-radio h-4 w-4 text-green-600" {{ old('knows_employee') == 'yes' ? 'checked' : '' }}>
                                <span class="ml-2">Yes</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="knows_employee" value="no" class="form-radio h-4 w-4 text-red-600" {{ old('knows_employee') == 'no' ? 'checked' : '' }}>
                                <span class="ml-2">No</span>
                            </label>
                        </div>
                        @error('knows_employee')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="employee-details" id="employeeDetailsSection">
                        <div class="p-4 bg-gray-50 rounded-md space-y-4">
                            <div>
                                <label for="position" class="block text-sm font-medium text-gray-700 mb-1">What is their position/title?</label>
                                <input type="text" name="position" id="position" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm" value="{{ old('position') }}">
                                @error('position')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="employment_status" class="block text-sm font-medium text-gray-700 mb-1">What is their employment status?</label>
                                <select name="employment_status" id="employment_status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                    <option value="">Select status</option>
                                    <option value="full-time" {{ old('employment_status') == 'full-time' ? 'selected' : '' }}>Full-time</option>
                                    <option value="part-time" {{ old('employment_status') == 'part-time' ? 'selected' : '' }}>Part-time</option>
                                    <option value="contract" {{ old('employment_status') == 'contract' ? 'selected' : '' }}>Contract</option>
                                    <option value="temporary" {{ old('employment_status') == 'temporary' ? 'selected' : '' }}>Temporary</option>
                                    <option value="former" {{ old('employment_status') == 'former' ? 'selected' : '' }}>Former employee</option>
                                </select>
                                @error('employment_status')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="employment_length" class="block text-sm font-medium text-gray-700 mb-1">How long have they been employed at your organization?</label>
                                <select name="employment_length" id="employment_length" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                    <option value="">Select duration</option>
                                    <option value="less-than-6-months" {{ old('employment_length') == 'less-than-6-months' ? 'selected' : '' }}>Less than 6 months</option>
                                    <option value="6-months-to-1-year" {{ old('employment_length') == '6-months-to-1-year' ? 'selected' : '' }}>6 months to 1 year</option>
                                    <option value="1-3-years" {{ old('employment_length') == '1-3-years' ? 'selected' : '' }}>1-3 years</option>
                                    <option value="3-5-years" {{ old('employment_length') == '3-5-years' ? 'selected' : '' }}>3-5 years</option>
                                    <option value="more-than-5-years" {{ old('employment_length') == 'more-than-5-years' ? 'selected' : '' }}>More than 5 years</option>
                                </select>
                                @error('employment_length')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Would you recommend this employee for financial assistance?</label>
                                <div class="mt-2 space-x-4">
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="recommend" value="yes" class="form-radio h-4 w-4 text-green-600" {{ old('recommend') == 'yes' ? 'checked' : '' }}>
                                        <span class="ml-2">Yes</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="recommend" value="no" class="form-radio h-4 w-4 text-red-600" {{ old('recommend') == 'no' ? 'checked' : '' }}>
                                        <span class="ml-2">No</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="recommend" value="unsure" class="form-radio h-4 w-4 text-yellow-600" {{ old('recommend') == 'unsure' ? 'checked' : '' }}>
                                        <span class="ml-2">Unsure</span>
                                    </label>
                                </div>
                                @error('recommend')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <label for="comments" class="block text-sm font-medium text-gray-700 mb-1">Additional Comments (Optional)</label>
                        <textarea name="comments" id="comments" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">{{ old('comments') }}</textarea>
                    </div>
                    
                    <div class="mt-8">
                        <button type="submit" class="w-full px-4 py-3 bg-green-600 text-white font-medium rounded-md shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Submit Verification
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <div class="mt-6 text-center text-sm text-gray-500">
        <p>If you have any questions about this verification request, please contact our support team.</p>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const knowsEmployeeRadios = document.querySelectorAll('input[name="knows_employee"]');
        const employeeDetailsSection = document.getElementById('employeeDetailsSection');
        
        // Function to toggle employee details section
        function toggleEmployeeDetails() {
            const knowsEmployee = document.querySelector('input[name="knows_employee"]:checked')?.value;
            
            if (knowsEmployee === 'yes') {
                employeeDetailsSection.classList.remove('hidden');
            } else {
                employeeDetailsSection.classList.add('hidden');
            }
        }
        
        // Initial check
        toggleEmployeeDetails();
        
        // Add event listeners
        knowsEmployeeRadios.forEach(radio => {
            radio.addEventListener('change', toggleEmployeeDetails);
        });
    });
</script>
@endpush
@endsection