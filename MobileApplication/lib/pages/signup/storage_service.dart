// ignore_for_file: avoid_print

import 'package:firebase_storage/firebase_storage.dart';
import 'dart:io';

class StorageService {
  final FirebaseStorage _storage = FirebaseStorage.instance;

  // Upload image to Firebase Storage
  Future<String> uploadImage(File image) async {
    try {
      final reference = _storage.ref().child('patient_images/${DateTime.now().millisecondsSinceEpoch}');
      final uploadTask = reference.putFile(image);
      final snapshot = await uploadTask.whenComplete(() {});
      final imageUrl = await snapshot.ref.getDownloadURL();
      return imageUrl;
    } catch (e) {
      print("Error uploading image: $e");
      return '';
    }
  }

  // Upload report to Firebase Storage
  Future<String> uploadReport(File report) async {
    try {
      final reference = _storage.ref().child('patient_reports/${DateTime.now().millisecondsSinceEpoch}');
      final uploadTask = reference.putFile(report);
      final snapshot = await uploadTask.whenComplete(() {});
      final reportUrl = await snapshot.ref.getDownloadURL();
      return reportUrl;
    } catch (e) {
      print("Error uploading report: $e");
      return '';
    }
  }
}
