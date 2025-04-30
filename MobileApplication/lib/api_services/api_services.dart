import 'dart:convert';

import 'package:http/http.dart' as http;
import 'dart:developer' as dev;

class ApiServices {
  String baseUrl = "http://10.0.2.2:8000/api";

  //login api
  login({
    required String email,
    required String password,
  }) async {
    try {
      final String apiUrl = "$baseUrl/login";

      final response = await http.post(
        Uri.parse(apiUrl),
        headers: {"Content-Type": "application/json"},
        body: jsonEncode({
          "email": email,
          "password": password,
        }),
      );

      if (response.statusCode == 200) {
      } else {}
    } catch (e) {
      dev.log(e.toString());
    }
  }
  //signup api

  // verify otp api
  Future<void> verifyOtp({
    required String email,
    required String otp,
  }) async {
    dev.log("Entered OTP: $otp");

    try {
      final response = await http.post(
        Uri.parse('$baseUrl/verify-otp'),
        headers: {'Content-Type': 'application/json'},
        body: jsonEncode({
          "email": email,
          "otp": otp,
        }),
      );

      dev.log("OTP Verify Response Code: ${response.statusCode}");
      dev.log("OTP Verify Response Body: ${response.body}");

      final responseData = jsonDecode(response.body);

      if (response.statusCode == 200) {
        dev.log('otp verified');
      } else {
        dev.log("${responseData['message']}");
      }
    } catch (e) {
      dev.log("Error: $e");
    }
  }

  // resend otp api
  Future<void> resendOtp({
    required String email,
  }) async {
    try {
      final response = await http.post(
        Uri.parse('$baseUrl/resend-otp'),
        headers: {'Content-Type': 'application/json'},
        body: jsonEncode({"email": email.toLowerCase()}),
      );

      dev.log("Resend OTP Response Code: ${response.statusCode}");
      dev.log("Resend OTP Response Body: ${response.body}");

      final responseData = jsonDecode(response.body);

      if (response.statusCode == 200) {
        dev.log("Resend OTP Success: ${responseData['message']}");
      } else {
        dev.log("Resend OTP Failed: ${responseData['message']}");
      }
    } catch (e) {
      dev.log("Error: $e");
    }
  }

  // register api
  registerApi({
    required String name,
    required String email,
    required String password,
    required String confirmPassword,
  }) async {
    dev.log('register api called');
    try {
      final response = await http.post(
        Uri.parse('$baseUrl/register'),
        headers: {'Content-Type': 'application/json'},
        body: jsonEncode({
          "name": name,
          "email": email.toLowerCase(),
          "password": password,
          "confirm_password": confirmPassword,
        }),
      );

      dev.log("Register Response Code: ${response.statusCode}");
      dev.log("Register Response Body: ${response.body}");

      final responseData = jsonDecode(response.body);

      if (response.statusCode == 200) {
        dev.log("Registration Successful: ${responseData['message']}");
      } else {
        dev.log("Registration Failed: ${responseData['message']}");
      }
    } catch (e) {
      dev.log("Error: $e");
    }
  }

  // get blog categories api
  getBlogAndCategories() async {
    try {
      final response = await http.get(
        Uri.parse('$baseUrl/blogs-categories'),
      );

      dev.log("Get Blog Categories Response Code: ${response.statusCode}");
      dev.log("Get Blog Categories Response Body: ${response.body}");

      final responseData = jsonDecode(response.body);

      if (response.statusCode == 200) {
        dev.log("Get Blog Categories Success: ${responseData['message']}");
      } else {
        dev.log("Get Blog Categories Failed: ${responseData['message']}");
      }
    } catch (e) {
      dev.log("Error: $e");
    }
  }
}
