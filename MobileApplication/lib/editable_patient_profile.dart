// ignore_for_file: use_super_parameters, use_build_context_synchronously, prefer_const_constructors

import 'package:flutter/material.dart';
import 'package:image_picker/image_picker.dart';
import 'dart:io';
import 'package:shared_preferences/shared_preferences.dart';

class EditablePatientProfile extends StatefulWidget {
  static String id = "/editablePatientProfile";

  const EditablePatientProfile({Key? key}) : super(key: key);

  @override
  State<EditablePatientProfile> createState() => _EditablePatientProfileState();
}

class _EditablePatientProfileState extends State<EditablePatientProfile> {
  // Controllers for the profile fields
  final TextEditingController _nameController = TextEditingController();
  final TextEditingController _ageController = TextEditingController();
  final TextEditingController _bloodGroupController = TextEditingController();

  File? _profileImage; // Stores the selected profile image
  final ImagePicker _picker = ImagePicker();

  @override
  void initState() {
    super.initState();
    _loadProfileData(); // Load saved data when the screen is opened
  }

  // Function to load saved profile data
  Future<void> _loadProfileData() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();

    // Load saved profile data (if any)
    setState(() {
      _nameController.text = prefs.getString('name') ?? '';
      _ageController.text = prefs.getString('age') ?? '';
      _bloodGroupController.text = prefs.getString('bloodGroup') ?? '';
      String? imagePath = prefs.getString('profileImagePath');
      if (imagePath != null) {
        _profileImage = File(imagePath);
      }
    });
  }

  // Function to save the profile changes
  Future<void> _saveProfile() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();

    // Save the profile data
    prefs.setString('name', _nameController.text);
    prefs.setString('age', _ageController.text);
    prefs.setString('bloodGroup', _bloodGroupController.text);

    if (_profileImage != null) {
      prefs.setString('profileImagePath', _profileImage!.path);
    }

    ScaffoldMessenger.of(context).showSnackBar(
      const SnackBar(content: Text('Profile Saved Successfully!')),
    );
  }

  // Function to pick an image from the gallery
  Future<void> _pickImage() async {
    final XFile? pickedImage =
        await _picker.pickImage(source: ImageSource.gallery);

    if (pickedImage != null) {
      setState(() {
        _profileImage = File(pickedImage.path);
      });

      // Save image path immediately after selection
      SharedPreferences prefs = await SharedPreferences.getInstance();
      prefs.setString('profileImagePath', pickedImage.path);
    }
  }

  @override
  Widget build(BuildContext context) {
    Size size = MediaQuery.of(context).size;

    return Scaffold(
      appBar: AppBar(
        title: const Text("Edit Patient Profile"),
        backgroundColor: Colors.blue,
      ),
      body: Padding(
        padding: const EdgeInsets.all(16.0),
        child: SingleChildScrollView(
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              // Profile Image Section
              Center(
                child: GestureDetector(
                  onTap: _pickImage,
                  child: CircleAvatar(
                    radius: size.width * 0.2,
                    backgroundImage: _profileImage != null
                        ? FileImage(_profileImage!)
                        : const AssetImage("assets/placeholder.png")
                            as ImageProvider,
                    child: _profileImage == null
                        ? const Icon(Icons.camera_alt,
                            size: 40, color: Colors.white)
                        : null,
                  ),
                ),
              ),
              const SizedBox(height: 20),

              // Name Input
              TextField(
                controller: _nameController,
                decoration: InputDecoration(
                  labelText: "Name",
                  border: OutlineInputBorder(),
                ),
              ),
              const SizedBox(height: 16),

              // Age Input
              TextField(
                controller: _ageController,
                keyboardType: TextInputType.number,
                decoration: InputDecoration(
                  labelText: "Age",
                  border: OutlineInputBorder(),
                ),
              ),
              const SizedBox(height: 16),

              // Blood Group Input
              TextField(
                controller: _bloodGroupController,
                decoration: InputDecoration(
                  labelText: "Blood Group",
                  border: OutlineInputBorder(),
                ),
              ),
              const SizedBox(height: 20),

              // Save Button
              Center(
                child: ElevatedButton.icon(
                  onPressed: _saveProfile,
                  icon: const Icon(Icons.save),
                  label: const Text("Save Profile"),
                  style: ElevatedButton.styleFrom(
                    minimumSize: Size(size.width * 0.6, 50),
                  ),
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }
}
