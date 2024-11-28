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

// Get the select element
const musicGenreSelect = document.getElementById("genre-option");

// Populate the select dropdown
musicGenres.forEach((genre) => {
	const option = document.createElement("option");
	option.value = genre.toLowerCase(); // Set the value in lowercase
	option.textContent = genre; // Set the visible text
	musicGenreSelect.appendChild(option);
});
