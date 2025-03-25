// ignore_for_file: unused_import, prefer_const_constructors, avoid_print, use_build_context_synchronously, library_private_types_in_public_api, unnecessary_import

import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:eye_disease_detection_app/pages/login/login.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import '../../app_style.dart';

class Signup extends StatefulWidget {
  static String id = "/signup";
  const Signup({super.key});

  @override
  _SignupState createState() => _SignupState();
}

class _SignupState extends State<Signup> {
  final TextEditingController _nameController = TextEditingController();
  final TextEditingController _emailController = TextEditingController();
  final TextEditingController _passwordController = TextEditingController();
  final TextEditingController _confirmPasswordController =
      TextEditingController();
  final TextEditingController _otpController = TextEditingController();
  bool isOtpFieldVisible = false;

  Future<void> registerUser() async {
    if (_nameController.text.isEmpty ||
        _emailController.text.isEmpty ||
        _passwordController.text.isEmpty ||
        _confirmPasswordController.text.isEmpty) {
      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(content: Text("Please fill all fields!")),
      );
      return;
    }

    try {
      final response = await http.post(
        Uri.parse('http://10.0.2.2:8000/api/register'),
        headers: {'Content-Type': 'application/json'},
        body: jsonEncode({
          "name": _nameController.text.trim(),
          "email": _emailController.text.trim().toLowerCase(),
          "password": _passwordController.text,
          "confirm_password": _confirmPasswordController.text,
        }),
      );

      print("Register Response Code: ${response.statusCode}");
      print("Register Response Body: ${response.body}");

      final responseData = jsonDecode(response.body);

      if (response.statusCode == 200) {
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(
              content: Text("Registration Successful! Please verify OTP.")),
        );
        setState(() {
          isOtpFieldVisible = true;
        });
      } else {
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(
              content: Text(responseData['message'] ?? "Registration Failed!")),
        );
      }
    } catch (e) {
      print("Error: $e");
      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(content: Text("Something went wrong! Please try again.")),
      );
    }
  }

  Future<void> verifyOtp() async {
    print("Entered OTP: ${_otpController.text}");

    try {
      final response = await http.post(
        Uri.parse('http://10.0.2.2:8000/api/verify-otp'),
        headers: {'Content-Type': 'application/json'},
        body: jsonEncode({
          "email": _emailController.text.trim().toLowerCase(),
          "otp": _otpController.text.trim(),
        }),
      );

      print("OTP Verify Response Code: ${response.statusCode}");
      print("OTP Verify Response Body: ${response.body}");

      final responseData = jsonDecode(response.body);

      if (response.statusCode == 200) {
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(content: Text("OTP Verified! You can now log in.")),
        );
        Navigator.of(context).pushNamed(Login.id);
      } else {
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(
              content: Text(
                  responseData['message'] ?? "Invalid OTP! Please try again.")),
        );
      }
    } catch (e) {
      print("Error: $e");
      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(content: Text("Something went wrong! Please try again.")),
      );
    }
  }

  Future<void> resendOtp() async {
    try {
      final response = await http.post(
        Uri.parse('http://10.0.2.2:8000/api/resend-otp'),
        headers: {'Content-Type': 'application/json'},
        body: jsonEncode({"email": _emailController.text.trim().toLowerCase()}),
      );

      print("Resend OTP Response Code: ${response.statusCode}");
      print("Resend OTP Response Body: ${response.body}");

      final responseData = jsonDecode(response.body);

      if (response.statusCode == 200) {
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(
              content:
                  Text(responseData['message'] ?? "OTP Resent Successfully!")),
        );
      } else {
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(content: Text("Failed to resend OTP!")),
        );
      }
    } catch (e) {
      print("Error: $e");
      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(content: Text("Something went wrong! Please try again.")),
      );
    }
  }

  @override
  Widget build(BuildContext context) {
    Size size = MediaQuery.of(context).size;
    return Scaffold(
      body: SingleChildScrollView(
        child: SafeArea(
          child: Padding(
            padding: EdgeInsets.symmetric(
              horizontal: size.width * 0.1,
              vertical: size.height * 0.035,
            ),
            child: Column(
              children: [
                Align(
                  alignment: Alignment.topCenter,
                  child: Image.asset(
                    logoImage,
                    height: size.height * 0.1,
                  ),
                ),
                SizedBox(height: size.height * 0.023),
                Text(
                  "Sign Up",
                  style: Theme.of(context).textTheme.titleLarge,
                ),
                SizedBox(height: size.height * 0.018),
                TextField(
                  controller: _nameController,
                  decoration: InputDecoration(
                      hintText: "Name", prefixIcon: Icon(Icons.person)),
                ),
                SizedBox(height: size.height * 0.016),
                TextField(
                  controller: _emailController,
                  decoration: InputDecoration(
                      hintText: "Email", prefixIcon: Icon(Icons.email)),
                ),
                SizedBox(height: size.height * 0.016),
                TextField(
                  controller: _passwordController,
                  obscureText: true,
                  decoration: InputDecoration(
                      hintText: "Password", prefixIcon: Icon(Icons.lock)),
                ),
                SizedBox(height: size.height * 0.016),
                TextField(
                  controller: _confirmPasswordController,
                  obscureText: true,
                  decoration: InputDecoration(
                      hintText: "Confirm Password",
                      prefixIcon: Icon(Icons.lock)),
                ),
                SizedBox(height: size.height * 0.025),
                ElevatedButton(
                  onPressed: registerUser,
                  child: Text("Sign Up"),
                ),
                if (isOtpFieldVisible) ...[
                  SizedBox(height: size.height * 0.016),
                  TextField(
                    controller: _otpController,
                    decoration: InputDecoration(
                        hintText: "Enter OTP",
                        prefixIcon: Icon(Icons.verified)),
                  ),
                  SizedBox(height: size.height * 0.016),
                  ElevatedButton(
                    onPressed: verifyOtp,
                    child: Text("Verify OTP"),
                  ),
                  TextButton(
                    onPressed: resendOtp,
                    child: Text("Resend OTP"),
                  ),
                ],
                SizedBox(height: size.height * 0.041),
                Row(
                  mainAxisAlignment: MainAxisAlignment.center,
                  children: [
                    Text("Already a member? "),
                    TextButton(
                      onPressed: () =>
                          Navigator.of(context).pushNamed(Login.id),
                      child: Text("Log In"),
                    ),
                  ],
                ),
              ],
            ),
          ),
        ),
      ),
    );
  }
}
