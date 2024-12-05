// ignore_for_file: avoid_print

import 'package:cloud_firestore/cloud_firestore.dart';

class FirestoreService {
  final FirebaseFirestore _db = FirebaseFirestore.instance;

  // Add a new patient profile
  Future<void> addPatientProfile({
    required String name,
    required String age,
    required String phone,
    required String gender,
    required String bloodGroup,
    required String medicalHistory,
    required String imageUrl,
    required String reportUrl,
  }) async {
    try {
      // Debugging print statements
      print("Adding patient profile with data:");
      print("Name: $name");
      print("Age: $age");
      print("Phone: $phone");
      print("Gender: $gender");
      print("Blood Group: $bloodGroup");
      print("Medical History: $medicalHistory");
      print("Image URL: $imageUrl");
      print("Report URL: $reportUrl");

      // Adding the patient profile to Firestore
      await _db.collection('patients').add({
        'name': name,
        'age': age,
        'phone': phone,
        'gender': gender,
        'bloodGroup': bloodGroup,
        'medicalHistory': medicalHistory,
        'imageUrl': imageUrl,
        'reportUrl': reportUrl,
        'createdAt': FieldValue.serverTimestamp(),
      });

      print("Patient profile added successfully!");
    } catch (e) {
      print("Error adding patient profile: $e");
    }
  }
}
