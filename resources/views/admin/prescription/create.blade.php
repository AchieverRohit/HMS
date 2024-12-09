@extends('layouts.admin')

@section('title', 'Prescription Form')

@section('content')
    <div class="container py-4">

        <!-- Prescription Form -->
        <form action="{{ route('admin.prescription.store', $id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Complaints Section -->
            <div class="mb-5">
                <div class="d-flex align-items-center mb-3">
                    <h2 class="h5 mb-0">Complaints</h2>
                </div>
                <table class="table table-bordered" id="complaintsTable">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Complaint Name</th>
                            <th>Frequency</th>
                            <th>Severity</th>
                            <th>Duration</th>
                            <th>Date</th>
                            <th>Note</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td><input type="text" class="form-control border-0 " name="complaintName[]" id="complaint">
                            </td>
                            <td><input type="text" class="form-control border-0 " name="frequency[]" id="complaint">
                            </td>
                            <td><input type="text" class="form-control border-0 " name="severity[]" id="complaint">
                            </td>
                            <td><input type="text" class="form-control border-0 " name="duration[]" id="complaint">
                            </td>
                            <td><input type="date" class="form-control border-0 " name="date[]" id="complaint"></td>
                            <td><input type="text" class="form-control border-0 " name="note[]" id="complaint"></td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-light p-0 remove-row">
                                    <span class="text-danger">&times;</span>
                                </button>
                            </td>
                            <ul id="complaint-suggestions" class="list-group position-absolute w-100"
                                style="z-index: 1000; display: none;">
                                <!-- Suggestions will appear here -->
                            </ul>
                        </tr>

                    </tbody>
                </table>
            </div>

            <!-- Diagnosis Section -->
            <div class="mb-5">
                <div class="d-flex align-items-center mb-3">
                    <h2 class="h5 mb-0">Diagnosis</h2>
                </div>
                <table class="table table-bordered" id="diagnosisTable">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Diagnosis</th>
                            <th>Duration</th>
                            <th>Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td><input type="text" class="form-control border-0" name="diagnosisName[]"></td>
                            <td><input type="text" class="form-control border-0" name="duration[]"></td>
                            <td><input type="date" class="form-control border-0" name="date[]"></td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-light p-0 remove-row">
                                    <span class="text-danger">&times;</span>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Tests Section -->
            <div class="mb-5">
                <div class="d-flex align-items-center mb-3">
                    <h2 class="h5 mb-0">Tests</h2>
                </div>
                <table class="table table-bordered" id="testsTable">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Test Name</th>
                            <th>Cost</th>
                            <th>Description</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td><input type="text" class="form-control border-0" name="testName[]"></td>
                            <td><input type="text" class="form-control border-0" name="cost[]"></td>
                            <td><input type="text" class="form-control border-0" name="description[]"></td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-light p-0 remove-row">
                                    <span class="text-danger">&times;</span>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Medicines Section -->
            <div class="mb-5">
                <div class="d-flex align-items-center mb-3">
                    <h2 class="h5 mb-0">Medicines</h2>
                </div>
                <table class="table table-bordered" id="medicinesTable">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Medicine Name</th>
                            <th>Dose</th>
                            <th>Frequency</th>
                            <th>When To Take</th>
                            <th>Duration</th>
                            <th>Instruction</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td><input type="text" class="form-control border-0" name="medicineName[]"></td>
                            <td><input type="text" class="form-control border-0" name="dose[]"></td>
                            <td><input type="text" class="form-control border-0" name="frequency[]"></td>
                            <td><input type="text" class="form-control border-0" name="whenToTake[]"></td>
                            <td><input type="text" class="form-control border-0" name="duration[]"></td>
                            <td><input type="text" class="form-control border-0" name="instruction[]"></td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-light p-0 remove-row">
                                    <span class="text-danger">&times;</span>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="mb-5">
                <label for="NextVisitDate">Follow up Date</label>
                <input type="date" name="NextVisitDate" id="NextVisitDate" class="form-control">
            </div>
            <!-- Save Prescription Button -->
            <div class="text-center">
                <button class="btn btn-primary">Save Prescription</button>
            </div>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sections = ['complaintsTable', 'diagnosisTable', 'testsTable', 'medicinesTable'];

            sections.forEach(sectionId => {
                const tableBody = document.querySelector(`#${sectionId} tbody`);

                // Add a new row when any field is filled
                tableBody.addEventListener('input', () => {
                    const lastRow = tableBody.lastElementChild;
                    const inputs = lastRow.querySelectorAll('input');

                    const allFilled = Array.from(inputs).some(input => input.value.trim() !== "");
                    if (allFilled) {
                        const newRow = lastRow.cloneNode(true);
                        Array.from(newRow.querySelectorAll('input')).forEach(input => input.value =
                            '');
                        tableBody.appendChild(newRow);
                    }
                });

                // Remove a row
                tableBody.addEventListener('click', (e) => {
                    if (e.target.closest('.remove-row')) {
                        const row = e.target.closest('tr');
                        if (tableBody.children.length > 1) row.remove();
                    }
                });
            });
        });

        const compalintSuggestions = @json($complaints->toArray());

        const filtercompalintSuggestions = () => {
            const complaintSuggestionsList = document.getElementById("complaint-suggestions");
            complaintSuggestionsList.innerHtml = "";

            try {
                if (compalintSuggestions.length > 0) {
                    compalintSuggestions.forEach((complaint) => {
                        const li = document.createElement("li");
                        li.className = "";
                        li.textContent = `${complaint.ComplaintName || ""} ${complaint.Frequency || ""}
                        ${complaint.Severity || ""} ${complaint.Duration || ""}  ${complaint.Date || ""}`;
                        li.style.cursor = "pointer";
                        li.onclick = () => {

                        }

                        complaintSuggestionsList.appendChild(li);
                    })
                    suggestionsList.style.display = "block";

                } else {
                    suggestionsList.style.display = "none";

                }
            } catch (error) {
                console.error("Error filtering suggestions:", error);
            }
        }
    </script>
@endsection
