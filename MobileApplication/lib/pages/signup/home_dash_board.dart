// ignore_for_file: use_super_parameters, library_private_types_in_public_api, sort_child_properties_last, prefer_const_constructors, prefer_const_literals_to_create_immutables

import 'package:eye_disease_detection_app/editable_patient_profile.dart';
import 'package:flutter/material.dart';
import 'package:image_picker/image_picker.dart';
import 'package:file_picker/file_picker.dart';
import 'dart:io';

class HomeDashboard extends StatefulWidget {
  static String id = "/homeDashboard";
  const HomeDashboard({Key? key}) : super(key: key);

  @override
  _HomeDashboardState createState() => _HomeDashboardState();
}

class _HomeDashboardState extends State<HomeDashboard> {
  XFile? image;
  File? reportFile;
  String? imageSource; // Tracks the source of the displayed image

  final ImagePicker _picker = ImagePicker();

  Future<void> pickImage() async {
    final XFile? pickedFile =
        await _picker.pickImage(source: ImageSource.gallery);
    setState(() {
      image = pickedFile;
      imageSource = "filePicker";
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
        imageSource = "filePicker";
      });
    }
  }

  Future<void> captureImage() async {
    final XFile? pickedFile = await _picker.pickImage(source: ImageSource.camera);
    if (pickedFile != null) {
      setState(() {
        image = pickedFile;
        imageSource = "camera";
      });
    }
  }

  void logout() {
    Navigator.pushReplacementNamed(context, '/login');
  }

  @override
  Widget build(BuildContext context) {
    Size size = MediaQuery.of(context).size;

    return Scaffold(
      drawer: Drawer(
        child: ListView(
          padding: EdgeInsets.zero,
          children: [
            const DrawerHeader(
              child: Text('Menu',
                  style: TextStyle(color: Colors.white, fontSize: 24)),
              decoration: BoxDecoration(
                color: Colors.blue,
              ),
            ),
            ListTile(
              leading: const Icon(Icons.logout, color: Colors.blue),
              title: const Text('Logout'),
              onTap: logout,
            ),
          ],
        ),
      ),
      appBar: AppBar(
        title: const Text('Home Dashboard'),
        backgroundColor: Colors.blue,
      ),
      body: Center(
        child: Padding(
          padding: EdgeInsets.symmetric(
              horizontal: size.width * 0.1, vertical: size.height * 0.03),
          child: Column(
            mainAxisAlignment: MainAxisAlignment.center,
            children: [
              // Patient Profile Button
              GestureDetector(
                onTap: () {
                  Navigator.pushNamed(context, EditablePatientProfile.id);
                },
                child: Container(
                  width: size.width * 0.4,
                  height: size.width * 0.4,
                  decoration: BoxDecoration(
                    color: Colors.blue,
                    borderRadius: BorderRadius.circular(15),
                  ),
                  child: Column(
                    mainAxisAlignment: MainAxisAlignment.center,
                    children: [
                      const Icon(Icons.person, size: 45, color: Colors.white),
                      const SizedBox(height: 10),
                      const Text(
                        'Patient Profile',
                        style: TextStyle(
                            color: Colors.white,
                            fontSize: 16,
                            fontWeight: FontWeight.bold),
                      ),
                    ],
                  ),
                ),
              ),
              SizedBox(height: size.height * 0.03),

              // Import Disease Image Button
              GestureDetector(
                onTap: pickReportFile,
                child: Container(
                  width: size.width * 0.4,
                  height: size.width * 0.4,
                  decoration: BoxDecoration(
                    color: Colors.blue,
                    borderRadius: BorderRadius.circular(15),
                  ),
                  child: Column(
                    mainAxisAlignment: MainAxisAlignment.center,
                    children: [
                      const Icon(Icons.image, size: 45, color: Colors.white),
                      const SizedBox(height: 10),
                      const Text(
                        'Import Disease Image',
                        style: TextStyle(
                            color: Colors.white,
                            fontSize: 16,
                            fontWeight: FontWeight.bold),
                      ),
                    ],
                  ),
                ),
              ),
              SizedBox(height: size.height * 0.03),

              // Capture Disease Image Button
              GestureDetector(
                onTap: captureImage,
                child: Container(
                  width: size.width * 0.4,
                  height: size.width * 0.4,
                  decoration: BoxDecoration(
                    color: Colors.blue,
                    borderRadius: BorderRadius.circular(15),
                  ),
                  child: Column(
                    mainAxisAlignment: MainAxisAlignment.center,
                    children: [
                      const Icon(Icons.camera_alt, size: 45, color: Colors.white),
                      const SizedBox(height: 10),
                      const Text(
                        'Capture Disease Image',
                        style: TextStyle(
                            color: Colors.white,
                            fontSize: 15,
                            fontWeight: FontWeight.bold),
                      ),
                    ],
                  ),
                ),
              ),
              SizedBox(height: size.height * 0.03),

              // Display Captured or Imported Image
              if (imageSource != null)
                if (imageSource == "camera" && image != null) ...[
                  Text("Captured Disease Image",
                      style:
                          TextStyle(fontSize: 16, fontWeight: FontWeight.bold)),
                  SizedBox(height: 10),
                  Container(
                    width: size.width * 0.8,
                    height: size.height * 0.3,
                    decoration: BoxDecoration(
                      image: DecorationImage(
                        image: FileImage(File(image!.path)),
                        fit: BoxFit.cover,
                      ),
                      borderRadius: BorderRadius.circular(15),
                    ),
                  ),
                ]
              else if (imageSource == "filePicker" && reportFile != null) ...[
                Text("Selected Disease Image",
                    style:
                        TextStyle(fontSize: 16, fontWeight: FontWeight.bold)),
                SizedBox(height: 10),
                Container(
                  width: size.width * 0.8,
                  height: size.height * 0.3,
                  decoration: BoxDecoration(
                    image: DecorationImage(
                      image: FileImage(reportFile!),
                      fit: BoxFit.cover,
                    ),
                    borderRadius: BorderRadius.circular(15),
                  ),
                ),
              ],
            ],
          ),
        ),
      ),
    );
  }
} 