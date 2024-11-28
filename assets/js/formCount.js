// document.getElementById("add-button").addEventListener("click", function () {
// 	const formContainer = document.getElementById("form-container");
// 	const formCount = formContainer.querySelectorAll(".card").length + 1; // Get the current count of cards

// 	// Create a new card
// 	const newCard = document.createElement("div");
// 	newCard.classList.add("card", "mb-3");
// 	newCard.innerHTML = `
//         <div class="card-body">
//             <div class="modal-body">
//                 <div class="form-group mb-3">
//                     <label for="namaBand${formCount}" class="form-label">Nama Band</label>
//                     <input type="text" name="nama_band[]" class="form-control" id="namaBand${formCount}">
//                 </div>

//                 <div class="input-group mb-3">
//                     <label class="input-group-text" for="genre${formCount}">Genre</label>
//                     <select class="form-select" name="genre[]" id="genre${formCount}">
//                         <option selected>Choose...</option>
//                     </select>
//                 </div>

//                 <div class="form-group mb-3">
//                     <label for="contact${formCount}" class="form-label">No Telepon</label>
//                     <input type="number" name="contact[]" class="form-control" id="contact${formCount}">
//                 </div>
//             </div>
//         </div>
//     `;

// 	formContainer.appendChild(newCard);
// });

// Array of popular music genres
const musicGenres = [
	"Pop",
	"Rock",
	"Hip Hop",
	"Jazz",
	"Classical",
	"Country",
	"Electronic",
	"Reggae",
	"Blues",
	"R&B",
	"Soul",
	"Funk",
	"Metal",
	"Folk",
	"Disco",
	"Grunge",
	"Punk",
	"Techno",
	"House",
	"Gospel",
	"Indie",
	"Opera",
	"Latin",
	"K-Pop",
	"J-Pop",
	"Dance",
	"Trap",
	"Dubstep",
	"Ambient",
];

let counter = 1; // Initialize the counter

// Function to populate options in a select element
function populateGenres(selectElement) {
	musicGenres.forEach((genre) => {
		const option = document.createElement("option");
		option.value = genre.toLowerCase(); // Set the value in lowercase
		option.textContent = genre; // Set the visible text
		selectElement.appendChild(option);
	});
}

// Populate the initial select dropdown
const initialSelect = document.getElementById(`genre1`);
populateGenres(initialSelect);

// Event listener to add a new card
document.getElementById("add-button").addEventListener("click", () => {
	counter++; // Increment the counter for unique IDs

	// Create a new card with the same structure
	const newCard = document.createElement("div");
	newCard.classList.add("card", "mb-3"); // Add card class

	newCard.innerHTML = `
		<div class="card-body">
			<div class="modal-body">
				<div class="form-group mb-3">
					<label for="namaBand${counter}" class="form-label">Nama Band</label>
					<input type="text" name="nama_band[]" class="form-control" id="namaBand${counter}">
				</div>
				
				<div class="input-group mb-3">
					<label class="input-group-text" for="genre${counter}">Genre</label>
					<select class="form-select" name="genre[]" id="genre${counter}">
						<option selected>Choose...</option>
					</select>
				</div>

				<div class="form-group mb-3">
					<label for="contact${counter}" class="form-label">No Telepon</label>
					<input type="number" name="contact[]" class="form-control" id="contact${counter}">
				</div>
			</div>
		</div>
	`;

	// Append the new card to the form container
	document.getElementById("form-container").appendChild(newCard);

	// Populate the new select dropdown with genres
	const newSelect = document.getElementById(`genre${counter}`);
	populateGenres(newSelect);
});
