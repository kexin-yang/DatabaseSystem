import java.io.File
import kotlin.random.Random

/* Schema:
ID
Job Title
Organization
Division
Position Type
Internal Status
App Deadline
*/

fun main() {
    val jobs = mutableListOf<Job>()

    var currentJob = Job()
    File("jobs.txt").forEachLine { line ->
        if (line.startsWith("View  Shortlist Apply")) {
            val formattedString = line.removePrefix("View  Shortlist Apply\t\t");
            currentJob.ID = formattedString.substring(0, 6).toInt()
            currentJob.JobTitle = formattedString.substring(7, formattedString.length)
        } else {
            val remainingData = line.split("\t")
            currentJob.Organization = remainingData[0]
            currentJob.Division = remainingData[1]
            currentJob.PositionType = remainingData[2]
            currentJob.InternalStatus = remainingData[3]
            currentJob.AppDeadline = remainingData[4]
            jobs.add(currentJob)
            currentJob = Job()
        }
    }

    /* generate filtered-jobs.txt
    jobs.forEach {
        println(it.ID.toString() + "|" + it.JobTitle + "|" + it.Organization + "|" + it.Division + "|" + it.PositionType + "|" + it.InternalStatus + "|" + it.AppDeadline)
    }
    */

    val companies = mutableListOf<Company>()
    jobs.forEach { job ->
        if (!companies.any { it.Organization == job.Organization }) {
            companies.add(Company(job.Organization, Random.nextInt(1, 101) / 10.0F))
        }
    }
    companies.forEach {
        println(it.Organization + "|" + it.Rating)
    }
}

data class Job(
    var ID: Int = 0, // primary key
    var JobTitle: String = "",
    var Organization: String = "",
    var Division: String = "",
    var PositionType: String = "",
    var InternalStatus: String = "",
    var AppDeadline: String = ""
)

data class Company(
    var Organization: String = "",
    var Rating: Float = 0.0F
)

//App Status
//ID
//Job Title
//Organization
//Division
//Position Type
//Internal Status
//App Deadline