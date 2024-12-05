import 'package:eye_disease_detection_app/editable_patient_profile.dart';
import 'package:eye_disease_detection_app/firebase_options.dart';
import 'package:eye_disease_detection_app/pages/login/login.dart';
//import 'package:eye_disease_detection_app/pages/signup/editable_patient_profile';
import 'package:eye_disease_detection_app/pages/signup/home_dash_board.dart';
import 'package:eye_disease_detection_app/pages/signup/patient_profile.dart';
import 'package:eye_disease_detection_app/pages/signup/signup.dart';
import 'package:firebase_core/firebase_core.dart';
import 'package:flutter/material.dart';

import 'app_style.dart';

Future<void> main() async {
  WidgetsFlutterBinding();

  await Firebase.initializeApp(
    options: DefaultFirebaseOptions.currentPlatform,
  );
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      title: 'Eye Disease App',
      theme: appTheme,
      routes: {
        Signup.id: (context) => const Signup(),
        Login.id: (context) => const Login(),
        PatientProfile.id: (context) => const PatientProfile(),
        HomeDashboard.id: (context) => const HomeDashboard(),
        EditablePatientProfile.id: (context) => const EditablePatientProfile(),
       // EditablePatientProfile.id: (context) => EditablePatientProfile(),
      },
      home: const Login(),
    );
  }
}


