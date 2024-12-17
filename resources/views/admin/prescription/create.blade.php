@extends('layouts.admin')

@section('title', 'Prescription Form')

@section('content')
<div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-body">
                            <h2>Dynamic Diagnosis Table</h2>
                            <form action="{{ route('admin.prescription.store', $id) }}" method="POST">
                                @csrf
                                <h4>Complaint Table</h4>
                                <table class="table table-bordered" id="complaintTable">
                                    <thead>
                                        <tr>
                                            <th>Complaint Name</th>
                                            <th>Complaint Note</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <!-- Complaint Input -->
                                                <input 
                                                    type="text" 
                                                    name="complaints[0][name]" 
                                                    class="form-control complaint-name" 
                                                    placeholder="Enter complaint Name"
                                                    required 
                                                    data-complaint-dropdown-id="dropdown_complaint_0">
                                                
                                                <!-- Dropdown Suggestions -->
                                                <ul id="dropdown_complaint_0" class="list-group" style="position: absolute; z-index: 1000; display: none;"></ul>
                                            </td>
                                            <td>
                                                <input 
                                                    type="text" 
                                                    name="complaints[0][note]" 
                                                    class="form-control" 
                                                    placeholder="Enter note" 
                                                    required>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-success" id="addComplaintRow">+</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <h4>Diagnosis Table</h4>
                                <table class="table table-bordered" id="diagnosisTable">
                                    <thead>
                                        <tr>
                                            <th>Diagnosis Name</th>
                                            <th>Duration</th>
                                            <th>Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <!-- Diagnosis Input -->
                                                <input 
                                                    type="text" 
                                                    name="diagnoses[0][name]" 
                                                    class="form-control diagnosis-name" 
                                                    placeholder="Enter Diagnosis Name" 
                                                    required 
                                                    data-dropdown-id="dropdown_diagnosis_0">
                                                
                                                <!-- Dropdown Suggestions -->
                                                <ul id="dropdown_diagnosis_0" class="list-group"></ul>
                                            </td>
                                            <td>
                                                <input 
                                                    type="text" 
                                                    name="diagnoses[0][duration]" 
                                                    class="form-control" 
                                                    placeholder="Enter Duration (e.g., 5 days)" 
                                                    required>
                                            </td>
                                            <td>
                                                <input 
                                                    type="date" 
                                                    name="diagnoses[0][date]" 
                                                    class="form-control" 
                                                    required>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-success" id="addRow">+</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        let rowIndex = 1;

        // Add Row Logic
        $('#addRow').on('click', function () {
            const newRow = `
                <tr>
                    <td>
                        <input type="text" name="diagnoses[${rowIndex}][name]" class="form-control diagnosis-name" placeholder="Enter Diagnosis Name" required data-dropdown-id="dropdown_diagnosis_${rowIndex}">
                        <ul id="dropdown_diagnosis_${rowIndex}" class="list-group"></ul>
                    </td>
                    <td>
                        <input type="text" name="diagnoses[${rowIndex}][duration]" class="form-control" placeholder="Enter Duration (e.g., 5 days)" required>
                    </td>
                    <td>
                        <input type="date" name="diagnoses[${rowIndex}][date]" class="form-control" required>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger removeRow">-</button>
                    </td>
                </tr>
            `;
            $('#diagnosisTable tbody').append(newRow);
            rowIndex++;
        });

        // Remove Row Logic
        $('#diagnosisTable').on('click', '.removeRow', function () {
            $(this).closest('tr').remove();
        });

        // Auto-search and appendChild logic
        $('#diagnosisTable').on('input', '.diagnosis-name', function () {
            const inputField = $(this);
            const dropdownId = inputField.data('dropdown-id');
            const dropdown = document.getElementById(dropdownId);
            const query = inputField.val().toLowerCase();

            dropdown.innerHTML = ""; // Clear previous suggestions
            if (!query || query.length < 2) { // Minimum 2 characters to trigger search
                dropdown.style.display = "none";
                return;
            }

            $.ajax({
                url: "{{ route('diagnosis.search-list') }}",
                type: "GET",
                data: { query },
                success: function (data) {
                    dropdown.innerHTML = "";
                    if (data.length > 0) {
                        data.forEach((diagnosis) => {
                            const li = document.createElement("li");
                            li.className = "list-group-item list-group-item-action";
                            li.textContent = diagnosis.DiagnosisName || "N/A";
                            li.style.cursor = "pointer";

                            // Add click event to set value
                            li.onclick = () => {
                                inputField.val(diagnosis.DiagnosisName);
                                dropdown.style.display = "none"; // Hide suggestions
                            };

                            dropdown.appendChild(li);
                        });
                        dropdown.style.display = "block";
                    } else {
                        dropdown.style.display = "none";
                    }
                },
                error: function (error) {
                    console.error("Error fetching suggestions:", error);
                }
            });
        });

        // Hide dropdown on outside click
        document.addEventListener('click', function (event) {
            const target = event.target;
            if (!target.closest('.diagnosis-name') && !target.closest('.list-group')) {
                document.querySelectorAll('.list-group').forEach((dropdown) => {
                    dropdown.style.display = "none";
                });
            }
        });
    });
</script>

<script>
document.addEventListener('DOMContentLoaded', () => {
    let complaintRowIndex = 1;

    function addComplaintRow() {
        const newRow = `
            <tr>
                <td>
                    <input 
                        type="text" 
                        name="complaints[${complaintRowIndex}][name]" 
                        class="form-control complaint-name" 
                        placeholder="Enter Complaint Name"
                        data-complaint-dropdown-id="dropdown_complaint_${complaintRowIndex}">
                    <ul id="dropdown_complaint_${complaintRowIndex}" class="list-group"></ul>
                </td>
                <td>
                    <input 
                        type="text" 
                        name="complaints[${complaintRowIndex}][note]" 
                        class="form-control" 
                        placeholder="Enter Note">
                </td>
                <td>
                    <button type="button" class="btn btn-danger removeComplaintRow">-</button>
                </td>
            </tr>
        `;
        document.querySelector('#complaintTable tbody').insertAdjacentHTML('beforeend', newRow);
        complaintRowIndex++;
    }

    document.getElementById('addComplaintRow').addEventListener('click', addComplaintRow);

    document.querySelector('#complaintTable').addEventListener('click', (e) => {
        if (e.target && e.target.classList.contains('removeComplaintRow')) {
            e.target.closest('tr').remove();
        }
    });

    // Handle AJAX search for each complaint input field
    document.querySelector('#complaintTable').addEventListener('input', async (e) => {
        if (e.target && e.target.classList.contains('complaint-name')) {
            const inputField = e.target;
            const dropdownComplaintId = inputField.getAttribute('data-complaint-dropdown-id');
            const dropdown = document.getElementById(dropdownComplaintId);
            const query = inputField.value.trim();

            if (query.length < 2) {
                dropdown.style.display = "none";
                return;
            }

            try {
                const response = await fetch(`{{ route('complaint.search-list') }}?query=${query}`);
                const data = await response.json();
                console.log("data :- ",data);

                dropdown.innerHTML = "";
                if (data.length) {
                    data.forEach(complaint => {
                        const li = document.createElement('li');
                        li.className = "list-group-item list-group-item-action";
                        li.textContent = complaint.ComplaintName || "N/A";
                        li.style.cursor = "pointer";

                        li.onclick = () => {
                            inputField.value = complaint.ComplaintName;
                            dropdown.style.display = "none";
                        };

                        dropdown.appendChild(li);
                    });
                    dropdown.style.display = "block";
                } else {
                    dropdown.style.display = "none";
                }
            } catch (error) {
                console.error("Error fetching complaint search results:", error);
            }
        }
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', (event) => {
        if (!event.target.closest('.complaint-name') && !event.target.closest('.list-group')) {
            document.querySelectorAll('.list-group').forEach(dropdown => {
                dropdown.style.display = "none";
            });
        }
    });
});
</script>

@endsection
