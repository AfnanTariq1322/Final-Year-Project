// ignore_for_file: use_build_context_synchronously, library_private_types_in_public_api, use_super_parameters

import 'package:eye_disease_detection_app/firestore_service.dart';
import 'package:eye_disease_detection_app/pages/signup/home_dash_board.dart';
import 'package:eye_disease_detection_app/pages/signup/storage_service.dart';
import 'package:flutter/material.dart';
import 'package:image_picker/image_picker.dart';
import 'package:file_picker/file_picker.dart';
//import 'package:eye_disease_detection_app/services/firestore_service.dart';
//import 'package:eye_disease_detection_app/services/storage_service.dart';
import 'dart:io';

class PatientProfile extends StatefulWidget {
  static String id = "/patientProfile";
  const PatientProfile({Key? key}) : super(key: key);

  @override
  _PatientProfileState createState() => _PatientProfileState();
}

class _PatientProfileState extends State<PatientProfile> {
  final _formKey = GlobalKey<FormState>();
  TextEditingController nameController = TextEditingController();
  TextEditingController phoneController = TextEditingController();
  TextEditingController medicalHistoryController = TextEditingController();
  TextEditingController ageController = TextEditingController();
  String? selectedBloodGroup = 'A+';
  String? selectedGender = 'Male'; // Default gender option
  XFile? image;
  File? reportFile;
  bool isLoading = false; // Loading state for save button

  String? imageError; // Variable to hold image error message
  String? reportFileError; // Variable to hold report file error message

  final ImagePicker _picker = ImagePicker();

  Future<void> pickImage() async {
    final XFile? pickedFile =
        await _picker.pickImage(source: ImageSource.gallery);
    setState(() {
      image = pickedFile;
      imageError = null; // Clear error message when image is picked
    });
  }

  Future<void> pickReportFile() async {
    FilePickerResult? result = await FilePicker.platform.pickFiles(
      type: FileType.custom,
      allowedExtensions: ['pdf', 'docx', 'jpg', 'png'],
    );
    if (result != null) {
      setState(() {
        reportFile = File(result.files.single.path!);
        reportFileError = null; // Clear error message when report is picked
      });
    }
  }

  bool _validateForm() {
    bool isValid = _formKey.currentState!.validate();

    // Check if the image is uploaded
    if (image == null) {
      setState(() {
        imageError = 'Please upload an image';
      });
      isValid = false;
    } else {
      setState(() {
        imageError = null; // Clear error if image is uploaded
      });
    }

    // Check if the medical report is attached
    if (reportFile == null) {
      setState(() {
        reportFileError = 'Please attach a medical report';
      });
      isValid = false;
    } else {
      setState(() {
        reportFileError = null; // Clear error if report is attached
      });
    }

    return isValid;
  }

  @override
  Widget build(BuildContext context) {
    Size size = MediaQuery.of(context).size;

    return Scaffold(
      appBar: AppBar(
        backgroundColor: Colors.blue,
        title: const Text(
          'Add Patient Details',
          style: TextStyle(
              fontSize: 25,
              color: Colors.white), // Decrease size, set white color
        ),
      ),
      body: Padding(
        padding: EdgeInsets.symmetric(
            horizontal: size.width * 0.1, vertical: size.height * 0.03),
        child: SingleChildScrollView(
          child: Form(
            key: _formKey,
            child: Column(
              children: [
                // Image Picker
                GestureDetector(
                  onTap: pickImage,
                  child: CircleAvatar(
                    radius: 60,
                    backgroundImage: image == null
                        ? const AssetImage('assets/default-avatar.png')
                        : FileImage(File(image!.path)),
                    child: image == null
                        ? const Icon(Icons.camera_alt,
                            size: 40, color: Color.fromARGB(255, 122, 149, 223))
                        : null,
                  ),
                ),
                if (imageError != null) // Display error if no image is uploaded
                  Padding(
                    padding: const EdgeInsets.only(top: 8.0),
                    child: Text(
                      imageError!,
                      style: const TextStyle(color: Colors.red),
                    ),
                  ),
                SizedBox(height: size.height * 0.01),
                const Text('Edit Image', style: TextStyle(color: Colors.grey)),
                SizedBox(height: size.height * 0.02),

                // Name TextField (1st)
                TextFormField(
                  controller: nameController,
                  decoration: const InputDecoration(labelText: 'Name'),
                  validator: (value) {
                    if (value == null || value.isEmpty) {
                      return 'Please enter the name';
                    }
                    return null;
                  },
                ),
                SizedBox(height: size.height * 0.02),

                // Age TextField (2nd)
                TextFormField(
                  controller: ageController,
                  decoration: const InputDecoration(labelText: 'Age'),
                  keyboardType: TextInputType.number,
                  validator: (value) {
                    if (value == null || value.isEmpty) {
                      return 'Please enter the age';
                    }
                    return null;
                  },
                ),
                SizedBox(height: size.height * 0.02),

                // Row with Gender and Blood Group (3rd and 4th fields in one row)
                Row(
                  children: [
                    // Gender Dropdown
                    Expanded(
                      child: DropdownButtonFormField<String>(
                        value: selectedGender,
                        decoration: const InputDecoration(
                          labelText: 'Gender',
                          contentPadding: EdgeInsets.symmetric(vertical: 10.0),
                        ),
                        items: ['Male', 'Female', 'Other']
                            .map((gender) => DropdownMenuItem<String>(
                                  value: gender,
                                  child: Text(
                                    gender,
                                    style: const TextStyle(color: Colors.black),
                                  ),
                                ))
                            .toList(),
                        onChanged: (value) {
                          setState(() {
                            selectedGender = value;
                          });
                        },
                      ),
                    ),
                    SizedBox(
                        width: size.width * 0.05), // Spacer between dropdowns

                    // Blood Group Dropdown
                    Expanded(
                      child: DropdownButtonFormField<String>(
                        value: selectedBloodGroup,
                        decoration: const InputDecoration(
                          labelText: 'Blood Group',
                          contentPadding: EdgeInsets.symmetric(vertical: 10.0),
                        ),
                        items: [
                          'A+',
                          'B+',
                          'O+',
                          'AB+',
                          'A-',
                          'B-',
                          'O-',
                          'AB-'
                        ]
                            .map((bloodGroup) => DropdownMenuItem<String>(
                                  value: bloodGroup,
                                  child: Text(
                                    bloodGroup,
                                    style: const TextStyle(color: Colors.black),
                                  ),
                                ))
                            .toList(),
                        onChanged: (value) {
                          setState(() {
                            selectedBloodGroup = value;
                          });
                        },
                      ),
                    ),
                  ],
                ),
                SizedBox(height: size.height * 0.02),

                // Phone Number TextField (5th)
                TextFormField(
                  controller: phoneController,
                  decoration: const InputDecoration(labelText: 'Phone Number'),
                  keyboardType: TextInputType.phone,
                  validator: (value) {
                    if (value == null || value.isEmpty) {
                      return 'Please enter the phone number';
                    }
                    return null;
                  },
                ),
                SizedBox(height: size.height * 0.02),

                // Medical History TextField (6th)
                TextFormField(
                  controller: medicalHistoryController,
                  decoration:
                      const InputDecoration(labelText: 'Medical History'),
                  maxLines: 3,
                ),
                SizedBox(height: size.height * 0.03),

                // Medical Report File Picker (linkable text)
                GestureDetector(
                  onTap: pickReportFile,
                  child: const Text(
                    'Attach Medical Report',
                    style: TextStyle(
                      color: Colors.blue,
                      decoration: TextDecoration.underline,
                      fontSize:
                          16, // Increase text size for "Attach Medical Report"
                    ),
                  ),
                ),
                if (reportFileError !=
                    null) // Display error if no report is attached
                  Padding(
                    padding: const EdgeInsets.only(top: 8.0),
                    child: Text(
                      reportFileError!,
                      style: const TextStyle(color: Colors.red),
                    ),
                  ),
                SizedBox(height: size.height * 0.02),

                // Display Report File Link if selected
                if (reportFile != null)
                  GestureDetector(
                    onTap: () {
                      // Open the file
                    },
                    child: Text(
                      'Report: ${reportFile!.path.split('/').last}',
                      style: const TextStyle(
                          color: Colors.blue,
                          decoration: TextDecoration.underline),
                    ),
                  ),
                SizedBox(height: size.height * 0.03),

                // Save Button with navigation to HomeDashboard
                // Save Button with navigation to HomeDashboard
                ElevatedButton(
                  style: ElevatedButton.styleFrom(
                    backgroundColor:
                        Colors.black, // Change button color to black
                    foregroundColor: Colors.white, // Set text color to white
                  ),
                  onPressed: () async {
                    if (_validateForm()) {
                      setState(() {
                        isLoading = true; // Show loading indicator
                      });

                      // Upload the image to Firebase Storage
                      String imageUrl = '';
                      if (image != null) {
                        imageUrl = await StorageService()
                            .uploadImage(File(image!.path));
                      }

                      // Upload the report to Firebase Storage
                      String reportUrl = '';
                      if (reportFile != null) {
                        reportUrl =
                            await StorageService().uploadReport(reportFile!);
                      }

                      // Save the patient profile to Firestore
                      await FirestoreService().addPatientProfile(
                        name: nameController.text,
                        age: ageController.text,
                        phone: phoneController.text,
                        gender: selectedGender!,
                        bloodGroup: selectedBloodGroup!,
                        medicalHistory: medicalHistoryController.text,
                        imageUrl: imageUrl,
                        reportUrl: reportUrl,
                      );

                      setState(() {
                        isLoading = false; // Hide loading indicator
                      });

                      // Show a success message using SnackBar
                      ScaffoldMessenger.of(context).showSnackBar(
                        const SnackBar(
                          content: Text('Patient details saved successfully!'),
                          backgroundColor: Colors
                              .green, // You can change the color as needed
                        ),
                      );

                      // Delay navigation to allow user to see the success message
                      await Future.delayed(const Duration(seconds: 2));

                      // Navigate to the Home Dashboard after saving data
                      Navigator.pushReplacement(
                        context,
                        MaterialPageRoute(
                            builder: (context) => const HomeDashboard()),
                      );
                    }
                  },
                  child: isLoading
                      ? const CircularProgressIndicator(
                          color: Colors.white,
                        )
                      : const Text('Save'),
                ),
              ],
            ),
          ),
        ),
      ),
    );
  }
}
