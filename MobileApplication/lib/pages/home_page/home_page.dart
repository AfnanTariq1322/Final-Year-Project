// ignore_for_file: unnecessary_import, prefer_const_constructors, avoid_print, prefer_const_literals_to_create_immutables

import 'package:eye_disease_detection_app/functions/global_functions.dart';
import 'package:eye_disease_detection_app/pages/blogs_page/blogs_page.dart';
import 'package:eye_disease_detection_app/pages/profile_page/user_profile.dart';
import 'package:eye_disease_detection_app/pages/diagnosis/diagnosis_page.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:eye_disease_detection_app/pages/login/login.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';
import 'package:shared_preferences/shared_preferences.dart';

class HomePage extends StatefulWidget {
  const HomePage({super.key});

  @override
  State<HomePage> createState() => _HomePageState();
}

class _HomePageState extends State<HomePage> {
  int _selectedIndex = 0;
  String? _token;
  bool _isLoggingOut = false;

  @override
  void initState() {
    super.initState();
    _loadToken();
  }

  Future<void> _loadToken() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    setState(() {
      _token = prefs.getString('auth_token');
    });
  }

  Future<void> _logout() async {
    if (_token == null) {
      ScaffoldMessenger.of(context).showSnackBar(
        const SnackBar(content: Text('No token found. Please login again.')),
      );
      Navigator.of(context).pushReplacement(
        MaterialPageRoute(builder: (context) => const Login()),
      );
      return;
    }

    setState(() => _isLoggingOut = true);

    try {
      print('Attempting logout...');
      
      final response = await http.post(
        Uri.parse('http://10.0.2.2:8000/api/logout'),
        headers: {
          'Authorization': 'Bearer $_token',
          'Content-Type': 'application/json',
          'Accept': 'application/json',
        },
      );

      print('Response status code: ${response.statusCode}');
      print('Response body: ${response.body}');

      if (response.statusCode == 200) {
        print('Logout successful');
        // Clear the token from SharedPreferences
        SharedPreferences prefs = await SharedPreferences.getInstance();
        await prefs.remove('auth_token');
        
        if (mounted) {
          // Show success message
          ScaffoldMessenger.of(context).showSnackBar(
            const SnackBar(
              content: Text('Logout successful!'),
              backgroundColor: Colors.green,
              duration: Duration(seconds: 2),
            ),
          );
          
          // Wait for the snackbar to show before navigating
          await Future.delayed(const Duration(seconds: 2));
          
          Navigator.of(context).pushReplacement(
            MaterialPageRoute(builder: (context) => const Login()),
          );
        }
      } else {
        // If token is expired or invalid, still navigate to login page
        final responseBody = json.decode(response.body);
        if (responseBody['error']?.toString().contains('expired') ?? false) {
          print('Token expired, navigating to login page');
          // Clear the token from SharedPreferences
          SharedPreferences prefs = await SharedPreferences.getInstance();
          await prefs.remove('auth_token');
          
          if (mounted) {
            Navigator.of(context).pushReplacement(
              MaterialPageRoute(builder: (context) => const Login()),
            );
          }
        } else {
          print('Logout failed with status code: ${response.statusCode}');
          if (mounted) {
            ScaffoldMessenger.of(context).showSnackBar(
              SnackBar(
                content: Text('Logout failed: ${response.body}'),
                backgroundColor: Colors.red,
              ),
            );
          }
        }
      }
    } catch (e) {
      print('Error during logout: $e');
      // On any error, navigate to login page
      if (mounted) {
        Navigator.of(context).pushReplacement(
          MaterialPageRoute(builder: (context) => const Login()),
        );
      }
    } finally {
      if (mounted) {
        setState(() => _isLoggingOut = false);
      }
    }
  }

  void _onItemTapped(int index) {
    setState(() {
      _selectedIndex = index;
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      extendBodyBehindAppBar: true,
      appBar: AppBar(
        title: Text(
          'Home',
          style: TextStyle(
            color: Colors.white, // Text color changed to white for better contrast
            fontWeight: FontWeight.bold,
            fontSize: 20,
          ),
        ),
        backgroundColor: Colors.transparent,
        elevation: 0,
        centerTitle: true,
        iconTheme: IconThemeData(color: Colors.white), // Changes back button color to white
      ),
      body: Stack(
        children: [
          Container(
            width: double.infinity,
            height: double.infinity,
            decoration: const BoxDecoration(
              gradient: LinearGradient(
                colors: [Color(0xFF6A1B9A), Color(0xFF9C4D97)], // Purple gradient background
                begin: Alignment.topLeft,
                end: Alignment.bottomRight,
              ),
            ),
            child: SafeArea(
              child: Center(
                child: Padding(
                  padding: const EdgeInsets.symmetric(horizontal: 30),
                  child: Column(
                    mainAxisAlignment: MainAxisAlignment.center,
                    children: [
                      Text(
                        "Welcome to EyeCare!",
                        style: TextStyle(
                          fontSize: 26,
                          fontWeight: FontWeight.bold,
                          color: Colors.white, // White text for better contrast
                        ),
                      ),
                      SizedBox(height: 40),

                      // Diagnosis Button
                      ElevatedButton.icon(
                        onPressed: () {
                          GlobalFunctions().nextScreen(context, const DiagnosisPage());
                        },
                        icon: Icon(Icons.visibility),
                        label: Text("Eye Diagnosis"),
                        style: ElevatedButton.styleFrom(
                          backgroundColor: Colors.purple, // Purple button background
                          foregroundColor: Colors.white, // White text for the button
                          padding: EdgeInsets.symmetric(vertical: 16, horizontal: 30),
                          shape: RoundedRectangleBorder(
                            borderRadius: BorderRadius.circular(30),
                          ),
                          elevation: 6,
                        ),
                      ),

                      SizedBox(height: 20),

                      // Blogs Button
                      ElevatedButton.icon(
                        onPressed: () {
                          GlobalFunctions().nextScreen(context, const BlogsScreen());
                        },
                        icon: Icon(Icons.article_outlined),
                        label: Text("Read Blogs"),
                        style: ElevatedButton.styleFrom(
                          backgroundColor: Colors.purple, // Purple button background
                          foregroundColor: Colors.white, // White text for the button
                          padding: EdgeInsets.symmetric(vertical: 16, horizontal: 30),
                          shape: RoundedRectangleBorder(
                            borderRadius: BorderRadius.circular(30),
                          ),
                          elevation: 6,
                        ),
                      ),

                      SizedBox(height: 20),

                      // Profile Page Button
                      ElevatedButton.icon(
                        onPressed: () {
                          GlobalFunctions().nextScreen(context, const UserDetailsPage());
                        },
                        icon: Icon(Icons.person_outline),
                        label: Text("My Profile"),
                        style: ElevatedButton.styleFrom(
                          backgroundColor: Colors.purple, // Purple button background
                          foregroundColor: Colors.white, // White text for the button
                          padding: EdgeInsets.symmetric(vertical: 16, horizontal: 30),
                          shape: RoundedRectangleBorder(
                            borderRadius: BorderRadius.circular(30),
                          ),
                          elevation: 6,
                        ),
                      ),
                    ],
                  ),
                ),
              ),
            ),
          ),
          if (_isLoggingOut)
            Container(
              color: Colors.black.withOpacity(0.5),
              child: Center(
                child: Column(
                  mainAxisAlignment: MainAxisAlignment.center,
                  children: [
                    CircularProgressIndicator(
                      valueColor: AlwaysStoppedAnimation<Color>(Colors.white),
                    ),
                    SizedBox(height: 16),
                    Text(
                      'Logging out...',
                      style: TextStyle(
                        color: Colors.white,
                        fontSize: 16,
                      ),
                    ),
                  ],
                ),
              ),
            ),
        ],
      ),
      bottomNavigationBar: BottomNavigationBar(
        items: const <BottomNavigationBarItem>[
          BottomNavigationBarItem(
            icon: Icon(Icons.home),
            label: 'Home',
          ),
          BottomNavigationBarItem(
            icon: Icon(Icons.medical_services),
            label: 'Diagnosis',
          ),
          BottomNavigationBarItem(
            icon: Icon(Icons.logout),
            label: 'Logout',
          ),
        ],
        currentIndex: _selectedIndex,
        selectedItemColor: const Color(0xFF6A1B9A),
        onTap: (index) {
          if (index == 1) {
            GlobalFunctions().nextScreen(context, const DiagnosisPage());
          } else if (index == 2) {
            _logout();
          } else {
            _onItemTapped(index);
          }
        },
      ),
    );
  }
}
