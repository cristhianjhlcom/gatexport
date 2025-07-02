import Dropzone from "dropzone";

window.Dropzone = Dropzone;

// Dropzone.autoDiscover = false;

// const dropzone = new Dropzone("#product-dropzone", {
//     url: "/admin/images/upload",
//     maxFilesize: 4.5,
//     maxFiles: 4,
//     acceptedFiles: ".png,.jpg,.jpeg,.webp,.svg",
//     addRemoveLinks: true,
//     dictDefaultMessage: "Drop files here or click to upload.",
//     dictRemoveFile: "Remove file",
//     headers: {
//         "X-CSRF-TOKEN": document
//             .querySelector("meta[name='csrf-token']")
//             .getAttribute("content"),
//     },
// });

// // TODO: Revisar sobre event dispatch de Livewire.
// dropzone.on("success", function (file, response) {
//     // Enviar datos a Livewire
//     console.log(response);
//     Livewire.dispatch("imageUploaded", {
//         image: response,
//     });
//     // Guardar filename en el archivo para remove
//     file.serverFileName = response.filename;
// });

// dropzone.on("error", function (file, errorMessage, xhr) {
//     console.log(errorMessage);
// });

// dropzone.on("removedfile", function (file) {
//     if (file.serverFileName) {
//         Livewire.dispatch("imageRemoved", {
//             filename: file.serverFileName,
//         });

//         // Opcional: eliminar archivo temporal del servidor
//         fetch(`/admin/images/delete-temp/${file.serverFileName}`, {
//             method: "DELETE",
//             headers: {
//                 "X-CSRF-TOKEN": document
//                     .querySelector('meta[name="csrf-token"]')
//                     .getAttribute("content"),
//             },
//         });
//     }
// });
