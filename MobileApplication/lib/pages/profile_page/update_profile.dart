// ignore_for_file: unused_import, avoid_print

import 'package:eye_disease_detection_app/functions/global_functions.dart';
import 'package:eye_disease_detection_app/pages/home_page/home_page.dart';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';
import 'package:eye_disease_detection_app/constants/constants.dart';
import 'package:eye_disease_detection_app/services/api_services/api_services.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:eye_disease_detection_app/pages/profile_page/user_profile.dart';

class UpdateUserProfilePage extends StatefulWidget {
  const UpdateUserProfilePage({super.key});

  @override
  State<UpdateUserProfilePage> createState() => _UpdateUserProfilePageState();
}

class _UpdateUserProfilePageState extends State<UpdateUserProfilePage> {
  final _formKey = GlobalKey<FormState>();
  final Map<String, TextEditingController> _controllers = {
    'name': TextEditingController(),
    'phone': TextEditingController(),
    'country': TextEditingController(),
    'city': TextEditingController(),
    'address': TextEditingController(),
    'medical_history': TextEditingController(),
    'symptoms': TextEditingController(),
    'visual_acuity': TextEditingController(),
    'eye_condition': TextEditingController(),
  };
  bool _isLoading = true;
  String? _errorMessage;

  final Color purpleColor = const Color(0xFF6A1B9A); // Main theme purple

  @override
  void initState() {
    super.initState();
    fetchUserProfile();
  }

  Future<void> fetchUserProfile() async {
    try {
      SharedPreferences prefs = await SharedPreferences.getInstance();
      String? token = prefs.getString('auth_token');

      if (token == null) {
        setState(() {
          _isLoading = false;
          _errorMessage = "Please login to view profile";
        });
        return;
      }

      final response = await http.get(
        Uri.parse('http://10.0.2.2:8000/api/profile'),
        headers: {
          'Content-Type': 'application/json',
          'Authorization': 'Bearer $token',
        },
      );

      if (response.statusCode == 200) {
        final data = jsonDecode(response.body);
        if (data['success'] == true) {
          final user = data['user'];
          for (var key in _controllers.keys) {
            _controllers[key]!.text = user[key]?.toString() ?? '';
          }
          setState(() {
            _isLoading = false;
          });
        } else {
          setState(() {
            _isLoading = false;
            _errorMessage = data['error'] ?? "Failed to load profile";
          });
        }
      } else {
        setState(() {
          _isLoading = false;
          _errorMessage = "Failed to load profile: ${response.statusCode}";
        });
      }
    } catch (e) {
      setState(() {
        _isLoading = false;
        _errorMessage = "Error fetching profile: $e";
      });
    }
  }

  Map<String, dynamic> _processField(String key, String value) {
    if (key == 'symptoms') {
      // Split by commas and clean up the array
      final symptomsList = value
          .split(',')
          .map((s) => s.trim())
          .where((s) => s.isNotEmpty)
          .toList();
      return {key: symptomsList};
    }
    return {key: value};
  }

  Future<void> updateProfile() async {
    if (!_formKey.currentState!.validate()) return;

    setState(() => _isLoading = true);

    final body = <String, dynamic>{};
    for (var field in _controllers.entries) {
      if (field.value.text.trim().isNotEmpty) {
        body.addAll(_processField(field.key, field.value.text.trim()));
      }
    }

    try {
      SharedPreferences prefs = await SharedPreferences.getInstance();
      String? token = prefs.getString('auth_token');

      if (token == null) {
        setState(() {
          _isLoading = false;
          _errorMessage = "Please login to update profile";
        });
        return;
      }

      print('Sending update request with body: $body'); // Debug log

      final response = await http.post(
        Uri.parse('http://10.0.2.2:8000/api/profile/update'),
        headers: {
          'Content-Type': 'application/json',
          'Authorization': 'Bearer $token',
        },
        body: jsonEncode(body),
      );

      print('Update response status: ${response.statusCode}'); // Debug log
      print('Update response body: ${response.body}'); // Debug log

      if (response.statusCode == 200) {
        final data = jsonDecode(response.body);
        if (data['success'] == true) {
          ScaffoldMessenger.of(context).showSnackBar(
            SnackBar(
              content: const Text('Profile updated successfully!'),
              backgroundColor: purpleColor,
            ),
          );
          Navigator.of(context).pushAndRemoveUntil(
            MaterialPageRoute(builder: (context) => const UserDetailsPage()),
            (route) => false,
          );
        } else {
          setState(() {
            _errorMessage = data['error'] ?? 'Failed to update profile';
          });
          ScaffoldMessenger.of(context).showSnackBar(
            SnackBar(
              content: Text(data['error'] ?? 'Failed to update profile'),
              backgroundColor: Colors.red,
            ),
          );
        }
      } else {
        final errorData = jsonDecode(response.body);
        setState(() {
          _errorMessage = errorData['errors']?['symptoms']?.first ??
              errorData['error'] ??
              'Failed to update profile: ${response.statusCode}';
        });
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(
            content: Text(errorData['errors']?['symptoms']?.first ??
                errorData['error'] ??
                'Failed to update profile: ${response.statusCode}'),
            backgroundColor: Colors.red,
          ),
        );
      }
    } catch (e) {
      print('Error updating profile: $e'); // Debug log
      setState(() {
        _errorMessage = 'Error updating profile: $e';
      });
      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(
          content: Text('Error updating profile: $e'),
          backgroundColor: Colors.red,
        ),
      );
    } finally {
      setState(() => _isLoading = false);
    }
  }

  Widget buildTextField(String label, TextEditingController controller) {
    return Padding(
      padding: const EdgeInsets.symmetric(vertical: 8),
      child: TextFormField(
        controller: controller,
        decoration: InputDecoration(
          labelText: label,
          labelStyle: TextStyle(color: purpleColor),
          focusedBorder: OutlineInputBorder(
            borderSide: BorderSide(color: purpleColor),
          ),
          border: const OutlineInputBorder(),
          hintText: label == 'Symptoms'
              ? 'Enter symptoms separated by commas (e.g., blurred vision, eye pain)'
              : null,
        ),
        validator: (value) => null,
      ),
    );
  }

  @override
  void dispose() {
    for (var controller in _controllers.values) {
      controller.dispose();
    }
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Update Profile'),
        backgroundColor: purpleColor,
        foregroundColor: Colors.white,
        leading: IconButton(
          icon: const Icon(Icons.arrow_back),
          onPressed: () {
            Navigator.of(context).pushReplacement(
              MaterialPageRoute(builder: (context) => const UserDetailsPage()),
            );
          },
        ),
      ),
      body: _isLoading
          ? const Center(child: CircularProgressIndicator())
          : _errorMessage != null
              ? Center(
                  child: Column(
                    mainAxisAlignment: MainAxisAlignment.center,
                    children: [
                      Text(
                        _errorMessage!,
                        style: const TextStyle(color: Colors.red),
                        textAlign: TextAlign.center,
                      ),
                      const SizedBox(height: 20),
                      ElevatedButton(
                        onPressed: () {
                          setState(() {
                            _isLoading = true;
                            _errorMessage = null;
                          });
                          fetchUserProfile();
                        },
                        style: ElevatedButton.styleFrom(
                          backgroundColor: purpleColor,
                        ),
                        child: const Text('Retry'),
                      ),
                    ],
                  ),
                )
              : Padding(
                  padding: const EdgeInsets.all(16.0),
                  child: Form(
                    key: _formKey,
                    child: ListView(
                      children: [
                        ..._controllers.entries.map((entry) => buildTextField(
                              entry.key.replaceAll('_', ' ').toUpperCase(),
                              entry.value,
                            )),
                        const SizedBox(height: 20),
                        ElevatedButton(
                          onPressed: _isLoading ? null : updateProfile,
                          style: ElevatedButton.styleFrom(
                            backgroundColor: purpleColor,
                            padding: const EdgeInsets.symmetric(vertical: 16),
                          ),
                          child: _isLoading
                              ? const SizedBox(
                                  width: 20,
                                  height: 20,
                                  child: CircularProgressIndicator(
                                    strokeWidth: 2,
                                    color: Colors.white,
                                  ),
                                )
                              : const Text(
                                  'Save Changes',
                                  style: TextStyle(color: Colors.white),
                                ),
                        ),
                      ],
                    ),
                  ),
                ),
    );
  }
}
